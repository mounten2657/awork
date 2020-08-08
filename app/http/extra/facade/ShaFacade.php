<?php

namespace app\http\extra\facade;

class ShaFacade
{

    /*
     * ˵����
     * PHP sha256 sha512Ŀǰ��PHP 7.1��û�����õĺ��������㣬sha1() sha1_file() md5() md5_file()�ֱ�������������ַ������ļ���sha1ɢ��ֵ��md5ɢ��ֵ����ǰ���°汾PHP 7.1 sha256() sha256_file() sha512() sha512_file()�����ĺ���Ҳû�С�SHA-2��SHA-224��SHA-256��SHA-384����SHA-512�ĺϳơ�
     * PHP ����sha256 sha512����ʹ��hash()����ʵ�֣������ļ���sha256 sha512�����ʹ��hash_file()ʵ�֡�
     * hash($algo , $data, $rawOutput);
     * hash_file($algo , $filepath, $rawOutput);
     * ����$algo���㷨��������sha256, sha512��ֵ��֧�ֵ��㷨����ʹ��hash_algos()�鿴���ú�����������֧�ֵ��㷨��
     * $data����Ҫ����hashֵ���ַ�����$filepath����Ҫ����hashֵ���ļ��������������·��Ҳ�����Ǿ���·����
     * $rawOutput��һ����ѡ�Ĳ���ֵ���������Ϊtrue���򷵻ض��������ݣ����Ϊfalse�򷵻��ַ�����Ĭ��ֵΪfalse.
     * ���ǿ��Է�װ�Զ��庯����ʵ��PHP ����sha256 sha512�Լ��������͵�hashֵ��
     * ���´���ʵ��PHP sha256() sha256_file() sha512() sha512_file() PHP 5.1.2+��������
     * @param string $data Ҫ����ɢ��ֵ���ַ���
     * @param boolean $rawOutput Ϊtrueʱ����ԭʼ���������ݣ����򷵻��ַ���
     * @param string file Ҫ����ɢ��ֵ���ļ����������ǵ������ļ�����Ҳ���԰���·��������·�����·��������
     * @return boolean | string ������Ч�����ļ������ڻ����ļ����ɶ�ʱ����false������ɹ��򷵻ض�Ӧ��ɢ��ֵ
     * @notes ʹ��ʾ�� sha256('www.wuxiancheng.cn') sha512('www.wuxiancheng.cn') sha256_file('index.php') sha512_file('index.php')
     * ������������ķ�����
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