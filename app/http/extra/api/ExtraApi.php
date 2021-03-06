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

use app\http\extra\facade\ShaFacade;
use simple\Sapp;

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

    /** @var Sapp app */
    private $app;

    /** @var string pass */
    private $pass = 'Infogo123456';

    /** @var int is product */
    private $isProduct;

    /**
     * get hosts
     * @return array
     */
    public function getHost()
    {
        $extApi = array(
            'tool_lu' => 'https://tool.lu',
        );
        $hosts = array(
            'host_self' => getBaseUri(),
            'host_asm' => '',
            'host_zenTao' => '',
            'host_gitLib' => '',
            'host_package' => '',
            'host_toolLu' => $extApi['tool_lu'],
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
        $this->isProduct = isTestEnv() ? 0 : 1;
    }

    /**
     * redirect system
     * @throws \Exception
     * @return mixed
     */
    public function redirect()
    {
        $this->app = \sapp();
        if (!($this->_api() && $this->_html() && $this->_mark() && $this->_string())) {
            throw new \Exception('Not Found', 404);
        }
        throw new \Exception('Method Not Allowed', 405);
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
                $this->app->http()->redirect($this->hosts['host_asm'] . '/test');
                break;
            case 'h210_auth':
                $this->app->http()->redirect($this->hosts['host_asm'] . '/');
                break;
            case 'h210_back':
                $this->app->http()->redirect($this->hosts['host_asm'] . '/admin');
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
                if ($this->isProduct) {
                    return sapp()->response()->fail('Html Server Offline!');
                }
                $url = $this->hosts['host_asm'] . '/test/?tradecode=getCurrentInfo';
                $res = sapp()->http()->request('post', $url);
                if (!isset($res['code'])) {
                    return sapp()->response()->fail(json_encode($res));
                }
                $res['data'] = array_merge($res['data'], array('isProduct' => $this->isProduct));
                return sapp()->response()->ok($res);
                break;
            case 'host_ip':
            case 'code_bch':
            case 'php_ver':
                return sapp()->response()->ok();
                break;
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
                $this->app->http()->redirect($this->hosts['host_self'] . ':' . $this->hosts['port_showDoc']);
                break;
            case 'redis_back':
                $this->app->http()->redirect($this->hosts['host_self'] . ':' . $this->hosts['port_redis']);
                break;
            case 'mongo_back':
                $this->app->http()->redirect($this->hosts['host_self'] . ':' . $this->hosts['port_mongo']);
                break;
            case 'github_i':
                $this->app->http()->redirect($this->hosts['host_gitLib'] . '/');
                break;
            case 'zentao_i':
                $this->app->http()->redirect($this->hosts['host_zenTao'] . '/');
                break;
            case 'h152_i':
                $this->app->http()->redirect($this->hosts['host_package'] . '/webdata/development/v6.0.3043.1906/');
                break;
        }
        return true;
    }

    private function _string()
    {
        $app = sapp();
        switch($this->type) {
            case 'sql_format':
                $code = $app->request()->get('code');
                $operate = $app->request()->get('operate');
                $data = array('code' => $code, 'operate' => $operate);
                $url = $this->hosts['host_toolLu']. '/sql/ajax.html';
                $res = $app->http()->request('post', $url, array('body' => $data));
                if (isset($res['text']) && $res['text']) {
                    return $app->response()->ok($res['text']);
                }
                return $app->response()->fail('SQL ERROR : ' . json_encode($res));
                break;
            case 'xml_format':
                $code = $app->request()->get('code');
                $operate = $app->request()->get('operate');
                $data = array('code' => $code, 'operate' => $operate);
                $url = $this->hosts['host_toolLu']. '/xml/ajax.html';
                $res = $app->http()->request('post', $url, array('body' => $data));
                if (isset($res['code']) && $res['code']) {
                    return $app->response()->ok($res['code']);
                }
                return $app->response()->fail('XML ERROR : ' . json_encode($res));
                break;
            case 'sha256':
                $code = $app->request()->get('code');
                if (!$code) {
                    return $app->response()->fail('Empty Slat!');
                }
                $res = ShaFacade::sha256($code);
                return $app->response()->ok($res);
                break;
            case 'sha512':
                $code = $app->request()->get('code');
                if (!$code) {
                    return $app->response()->fail('Empty Slat!');
                }
                $res = ShaFacade::sha512($code);
                return $app->response()->ok($res);
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