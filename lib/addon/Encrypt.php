<?php

namespace addon;

/**
 * 字符串加解密处理类
 */
class Encrypt
{

    /** @var int 加密操作类型 */
    const TYPE_ENCRYPT = 1;

    /** @var int 解密操作类型 */
    const TYPE_DECRYPT = 2;

    /**
     * 对字符串加密
     * @param string $string                     待加密字符串
     * @param string $key                        秘钥字符串
     * @return bool|mixed|string
     */
    public static function encrypt($string, $key = '')
    {
        return self::_arithmetic($string, self::TYPE_ENCRYPT, $key);
    }

    /**
     * 对字符串解密
     * @param string $string                     待解密字符串
     * @param string $key                        秘钥字符串
     * @return bool|mixed|string
     */
    public static function decrypt($string, $key = '')
    {
        return self::_arithmetic($string, self::TYPE_DECRYPT, $key);
    }

    /**
     * 加/解密预算
     * @param string $string                     待操作字符串
     * @param integer $operation                 操作类型
     * @param string $key                        秘钥字符串
     * @return bool|mixed|string
     */
    private static function _arithmetic($string, $operation, $key = '')
    {
        $key = $key ? : config('encrypt_key');
        $key = md5($key);
        $key_length = strlen($key);
        if (self::TYPE_DECRYPT === $operation) {
            $string = base64_decode(str_replace(['_', '-'], ['+', '/'], $string));
        } else {
            $string = substr(md5($string.$key), 0, 8).$string;
        }
        $string_length = strlen($string);
        $rndkey = $box = [];
        $result = '';
        for ( $i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i%$key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i =0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if (self::TYPE_DECRYPT === $operation) {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8).$key), 0, 8)) {
                return substr($result, 8);
            }
            return '';
        } else {
            $result = str_replace('=', '', base64_encode($result));
            return str_replace(['+', '/'], ['_', '-'], $result);
        }
    }

}