<?php
/**
 * extra api
 * @copyright (c) 2012-2020, Hangzhou Awork Tech Co., Ltd.
 * This is NOT a freeware, use is subject to license terms.
 * @package ExtraApi.php
 * @link http://www.awork.com
 * @author wujun
 * @: ExtraApi.php 311001 2020-08-24 15:28:54 wujun $
 * */

namespace app\http\extra\api;

/**
 * Class ExtraApi
 * @package app\http\extra\api
 * @see ExtraApi
 */
class ExtraApi
{

    /** @var array hosts */
    public $hosts;

    /** @var string type */
    public $type;

    /** @var string pass */
    private $pass = 'Infogo123456';

    /**
     * get hosts
     * @return array
     */
    public function getHost()
    {
        $hosts = array(
            'host_self' => getBaseUri(),
            'host_asm' => '',
            'host_zenTao' => '',
            'host_gitLib' => '',
            'host_package' => '',
            'port_showDoc' => '9051',
            'port_redis' => '8081',
            'port_mongo' => '1234',
        );
        if (isTestEnv()) {
            $hosts['host_asm'] = 'http://192.168.50.210';
            $hosts['host_zenTao'] = 'http://192.168.56.241';
            $hosts['host_gitLib'] = 'http://192.168.56.250';
            $hosts['host_package'] = 'http://192.168.56.152';
        }
        return $hosts;
    }

    /**
     * ExtraApi constructor.
     */
    public function __construct()
    {
        $this->hosts = $this->getHost();
        $this->type = $this->getType();
    }

    /**
     * redirect system
     * @throws \Exception
     * @return mixed
     */
    public function redirect()
    {
        if (!($this->_api() && $this->_html() && $this->_mark())) {
            throw new \Exception('Not Found', 10404);
        }
        return true;
    }

    /**
     * api redirect
     * @return bool
     */
    private function _api()
    {
        switch($this->type)
        {
            case 'h210_api':
                header('Location: ' . $this->hosts['host_asm'] . '/test');
                break;
            case 'h210_auth':
                header('Location: ' . $this->hosts['host_asm'] . '/');
                break;
            case 'h210_back':
                header('Location: ' . $this->hosts['host_asm'] . '/admin');
                break;
        }
        return true;
    }

    /**
     * html redirect
     * @return bool
     */
    private function _html()
    {
        switch($this->type)
        {
            case 'current_i':
                $url = $this->hosts['host_asm'] . '/test/?tradecode=getCurrentInfo';
                $res = sapp()->http()->request('post', $url);
                if (!isset($res['code'])) {
                    return sapp()->response()->fail(json_encode($res));
                }
                return sapp()->response()->ok($res);
                break;
            case 'host_ip':
            case 'code_bch':
            case 'php_ver':
            case 'ch_submit':
                $branch = sapp()->request()->get('branch');
                $php = sapp()->request()->get('php');
                $pass = sapp()->request()->get('pass');
                if (!$branch || !$php || !$pass) {
                    return sapp()->response()->fail('Invalid Request!');
                }
                if (md5(md5($this->pass)) !== $pass) {
                    return sapp()->response()->fail('Invalid Password!');
                }
                $url = $this->hosts['host_asm'] . '/test/?tradecode=setHtml';
                $data = array('branch' => $branch, 'php' => $php);
                $res = sapp()->http()->request('post', $url, array('body' => $data));
                if (!isset($res['code']) || isset($res['code']) && $res['code']) {
                    $ret = !isset($res['code']) ? array('code' => 30010,'msg' => 'Request Waiting... Please Refresh Page.', 'data' => $res) : $res;
                    $ret = array_merge($ret, array('request'=>array('url' => $url, 'params' => $data)));
                    return sapp()->response()->data($ret);
                }
                return sapp()->response()->data($res);
                break;
            case 'ch_check':
                header('Location: ' . $this->hosts['host_asm'] . '/test/?tradecode=phpinfo');
                break;
        }
        return true;
    }

    /**
     * mark redirect
     * @return bool
     */
    private function _mark()
    {
        switch($this->type)
        {
            case 'show_doc':
                header('Location: ' . $this->hosts['host_self'] . ':' . $this->hosts['port_showDoc']);
                break;
            case 'redis_back':
                header('Location: ' . $this->hosts['host_self'] . ':' . $this->hosts['port_redis']);
                break;
            case 'mongo_back':
                header('Location: ' . $this->hosts['host_self'] . ':' . $this->hosts['port_mongo']);
                break;
            case 'github_i':
                header('Location: ' . $this->hosts['host_gitLib'] . '/');
                break;
            case 'zentao_i':
                header('Location: ' . $this->hosts['host_zenTao'] . '/');
                break;
            case 'h152_i':
                header('Location: ' . $this->hosts['host_package'] . '/webdata/development/v6.0.3043.1906/');
                break;
        }
        return true;
    }

    /**
     * get uri type
     * @return string
     */
    public function getType()
    {
        $keys = array_keys($_GET);
        return isset($keys[0]) ? $keys[0] : 'unknown';
    }

}