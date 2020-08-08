<?php

namespace app\http\extra\facade;

class ShaFacade
{

    /*
     * 说明：
     * PHP sha256 sha512目前（PHP 7.1）没有内置的函数来计算，sha1() sha1_file() md5() md5_file()分别可以用来计算字符串和文件的sha1散列值和md5散列值，当前最新版本PHP 7.1 sha256() sha256_file() sha512() sha512_file()这样的函数也没有。SHA-2是SHA-224、SHA-256、SHA-384，和SHA-512的合称。
     * PHP 计算sha256 sha512可以使用hash()函数实现，计算文件的sha256 sha512则可以使用hash_file()实现。
     * hash($algo , $data, $rawOutput);
     * hash_file($algo , $filepath, $rawOutput);
     * 其中$algo是算法，可以是sha256, sha512等值，支持的算法可以使用hash_algos()查看，该函数返回所有支持的算法。
     * $data是需要计算hash值的字符串，$filepath是需要计算hash值的文件名，可以是相对路径也可以是绝对路径。
     * $rawOutput是一个可选的布尔值参数，如果为true，则返回二进制数据，如果为false则返回字符串，默认值为false.
     * 我们可以封装自定义函数来实现PHP 计算sha256 sha512以及其他类型的hash值。
     * 以下代码实现PHP sha256() sha256_file() sha512() sha512_file() PHP 5.1.2+完美兼容
     * @param string $data 要计算散列值的字符串
     * @param boolean $rawOutput 为true时返回原始二进制数据，否则返回字符串
     * @param string file 要计算散列值的文件名，可以是单独的文件名，也可以包含路径，绝对路径相对路径都可以
     * @return boolean | string 参数无效或者文件不存在或者文件不可读时返回false，计算成功则返回对应的散列值
     * @notes 使用示例 sha256('www.wuxiancheng.cn') sha512('www.wuxiancheng.cn') sha256_file('index.php') sha512_file('index.php')
     * 可用生成密码的方案：
     * $hash = "{SSHA256}" . base64_encode(hash('sha256', $password . $salt) . $salt);
    */

    /* PHP sha256() */
    public static function sha256($data, $rawOutput = false)
    {
        if (!is_scalar($data)) {
            return false;
        }
        $data = (string)$data;
        $rawOutput = !!$rawOutput;
        return hash('sha256', $data, $rawOutput);
    }

    /* PHP sha256File() */
    public static function sha256File($file, $rawOutput = false)
    {
        if (!is_scalar($file)) {
            return false;
        }
        $file = (string)$file;
        if (!is_file($file) || !is_readable($file)) {
            return false;
        }
        $rawOutput = !!$rawOutput;
        return hash_file('sha256', $file, $rawOutput);
    }

    /* PHP sha512() */
    public static function sha512($data, $rawOutput = false)
    {
        if (!is_scalar($data)) {
            return false;
        }
        $data = (string)$data;
        $rawOutput = !!$rawOutput;
        return hash('sha512', $data, $rawOutput);
    }

    /* PHP sha512File()*/
    public static function sha512File($file, $rawOutput = false)
    {
        if (!is_scalar($file)) {
            return false;
        }
        $file = (string)$file;
        if (!is_file($file) || !is_readable($file)) {
            return false;
        }
        $rawOutput = !!$rawOutput;
        return hash_file('sha512', $file, $rawOutput);
    }

}