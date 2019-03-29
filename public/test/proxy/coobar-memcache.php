#!/usr/local/php/bin/php
<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2020 (http://www.coobar.com)
 * @version    6.0
 * @author cst 2018/5/12 下午2:57
 * @internal cst
 */

main();

function main()
{
    $memcache = new MemHelper("localhost");
    $option = setOption();

    //获取列表
    if(array_key_exists("list",$option)){
        $result = $memcache->getKeys();
        echo "memcache keys list : " . PHP_EOL;
        foreach ($result as $info){
           echo $info . PHP_EOL;
        }
        if(empty($result)){
            echo "the list is empty" . PHP_EOL;
        }
    }

    //获取键值
    if(array_key_exists("get",$option)){
        $key = $option["get"];
        $result = $memcache->get($key);
        if(isset($result[1])){
            echo $result[1];
            return;
        }
        echo "the key is empty" . PHP_EOL;
    }

    //设置缓存
    if(array_key_exists("set",$option)){
        $data = $option["set"];
        $temp = explode(":",$data,2);
        if(count($temp) != 2){
            setOption(true);
            return;
        }
        $key = $temp[0];
        $value = trim($temp[1],":");
        $ttl = isset($option['ttl']) ? $option['ttl'] : 0;
        $result = $memcache->set($key, $value, $ttl);
        if($result){
            echo "success" . PHP_EOL;
        }else{
            echo "failed" . PHP_EOL;
        }
    }

    //删除键值
    //获取键值
    if(array_key_exists("delete",$option)){
        $key = $option["delete"];
        $result = $memcache->delete($key);
        if($result){
            echo "success" . PHP_EOL;
        }else{
            echo "failed" . PHP_EOL;
        }
    }
}

/**
 * 设置脚本时输入参数
 */
function setOption($isHelp = false)
{
    $longOpts = [
        "set:",//设置值
        "list", //获取列表
        "get:",//获取值
        "ttl:",//设置过期时间
        "delete:",//删除键值
        "help",//获取帮助
    ];
    $options = getopt("",$longOpts);
    if(empty($options) ||  array_key_exists('help',$options) || $isHelp){
        echo "欢迎使用 memcache小工具" . PHP_EOL;
        echo PHP_EOL;
        echo "--list 获取缓存键列表" .PHP_EOL;
        echo "--get key 获取指定键值" . PHP_EOL;
        echo "--set key:value [--ttl time] 设置键值,time 设置过期时间秒数" . PHP_EOL;
        echo "--delete key 删除键值".PHP_EOL;
        echo PHP_EOL;
        exit;
    }
    return $options;
}

/**
 * memcache 工具类
 * Class MemHelper
 */
class MemHelper
{
    private $memcache;
    public function __construct($host, $port = 11211, $timeout = 5)
    {
        $this->memcache = new MemCacheSocket($host, $port, $timeout);
    }

    /**
     * 获取memcached 所有的key
     */
    public function getKeys()
    {
       $items = $this->memcache->get("stats items");
       $idArr = [];
       //获取所有的item中的ID
       foreach ($items as $item){
           if(preg_match('/STAT items:(\d+):evicted_unfetched/',$item,$matches)){
               if(isset($matches[1]) && !in_array($matches[1],$idArr)){
                    $idArr[] = $matches[1];
               }
           }
       }

       //获取id对应的key
        $keys = [];
       if(!empty($idArr)){
           foreach ($idArr as $id){
               $result = $this->memcache->get("stats cachedump {$id} 0");
               foreach ($result as $name){
                   if(preg_match('/ITEM (.*?) \[[\s\S]*?\]/',$name,$matches)){
                       if(isset($matches[1]) && !in_array($matches[1],$idArr)){
                           $keys[] = $matches[1];
                       }
                   }
               }
           }

       }
       return $keys;
    }

    /**
     * memcache 获取键值
     * @param $key
     * @return array
     */
    public function get($key){
        $item = $this->memcache->get("get {$key}");
        return $item;
    }

    /**
     * 设置键值
     * @param $key
     * @param $value
     * @param int $ttl
     * @return bool
     */
    public function set($key, $value, $ttl = 0)
    {
        $ttl = intval($ttl);
        return $this->memcache->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        return $this->memcache->delete($key);
    }
}

/**
 * memcached 基于socket连接
 */
class MemCacheSocket
{
    private $fp;
    public function __construct($host, $port = 11211, $timeout = 5)
    {
        $this->fp = fsockopen("localhost","11211", $errno, $errstr, $timeout);
        if(!$this->fp){
            die("connect error , " . $errstr . PHP_EOL);
        }
    }

    public function get($key)
    {
        $cmd = "{$key} \r\n";
        if (!fwrite($this->fp, $cmd, strlen($cmd))){
            die("cmd send error" . PHP_EOL);
        }
        $result = $this->_getItmes();
        return $result;
    }

    public function set($key, $value, $ttl, $flag = 0)
    {
        $len = strlen($value);
        $cmd = "set {$key} $flag $ttl $len \r\n{$value}\r\n";
        if (!fwrite($this->fp, $cmd, strlen($cmd))){
            die("cmd send error" . PHP_EOL);
        }
        $line = trim(fgets($this->fp));
        if ($line == "STORED")
            return true;
        return false;
    }

    public function delete($key)
    {
        $cmd = "delete {$key} \r\n";
        if (!fwrite($this->fp, $cmd, strlen($cmd))){
            die("cmd send error" . PHP_EOL);
        }
        $line = trim(fgets($this->fp));
        if ($line == "DELETED")
            return true;
        return false;
    }

    private function _getItmes()
    {
        $result = [];
        while (true){
            $decl = fgets($this->fp);
            if(false === strpos($decl,'END')){
                $result[] = $decl;
            }else{
                break;
            }
        }
        return $result;
    }

    public function __destruct()
    {
        fclose($this->fp);
    }
}

