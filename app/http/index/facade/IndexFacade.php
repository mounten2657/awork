<?php

namespace app\http\index\facade;

use app\data\cache\coobar\OperationTreeCache;

/**
 * 首页 Facade
 */
class IndexFacade
{

    /**
     * getName
     * @return string
     */
    public static function getName()
    {
        return 'index facade';
    }

    /**
     * getOperationTreeList
     * @return mixed
     */
    public static function getOperationTreeList()
    {
        $list = OperationTreeCache::getList();
        $list['model'] = OperationTreeCache::getModel();
        return $list;
    }

    /**
     * get bat file content
     * @param $data
     * @return string
     */
    public static function getBat($data)
    {
        $project = $data[0];
        unset($data[0]);
        $data = array_merge($data, array());
        $droot = 'D:\\code\\'. $project .'\\';
        $path = array();
        foreach ($data as $key => $val) {
            if (!strpos($val, '/')) {
                $path[] = '';
                continue;
            }
            $path[] = strtr($val, array(strrchr($val, '/') => ''));
        }
        $path = array_filter(array_unique($path));
        $pathStr = '';
        foreach ($path as $p) {
            $pathStr .= 'md ' . strtr($p, '/', '\\') . PHP_EOL;
        }
        $fileStr = '';
        foreach ($data as $f) {
            $f = strtr($f, '/', '\\');
            $fileStr .= "copy /y {$droot}{$f} $f ". PHP_EOL;
        }
        $batStr  = "";
        $batStr .= "@echo off" . PHP_EOL . PHP_EOL;
        $batStr .= "echo start ..." . PHP_EOL;
        //$batStr .= "D: && cd D:\document" . PHP_EOL;
        //$batStr .= "md ". date('YmdHis') . PHP_EOL;
        $batStr .= "set h=%time:~0,2%" . PHP_EOL;
        $batStr .= "set h=%h: =0%" . PHP_EOL;
        $batStr .= "md %date:~0,4%%date:~5,2%%date:~8,2%_%h%%time:~3,2%%time:~6,2%" . PHP_EOL;
        $batStr .= "cd %date:~0,4%%date:~5,2%%date:~8,2%_%h%%time:~3,2%%time:~6,2%" . PHP_EOL;
        $batStr .= "md var\www\html" . PHP_EOL;
        $batStr .= "cd var\www\html" . PHP_EOL . PHP_EOL;
        $batStr .= "echo mkdir ..." . PHP_EOL;
        $batStr .= "{$pathStr}" . PHP_EOL;
        $batStr .= "echo copy file ..." . PHP_EOL;
        $batStr .= "{$fileStr}" . PHP_EOL;
        $batStr .= "pause" . PHP_EOL;
        return $batStr;
    }

}