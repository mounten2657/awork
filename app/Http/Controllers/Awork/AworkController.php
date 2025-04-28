<?php

namespace App\Http\Controllers\Awork;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AworkController extends Controller {

    /**
     * awork jump list
     *
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 10:47
     */
    public function index(Request $request) {
        // jump to target method
        $target = $request->get('t_code', 'index');
        if ($target != 'index') {
            $ret = $this->$target();
            if ($ret instanceof JsonResponse) {
                return $ret;
            }
            $ret = ['arg' => $request->all(), 'ret' => $ret];
            return $this->success($ret);
        }
        // list all methods
        echo "Current ID : " . md5(time()) . "<br>";
        $listHtml = '';
        $methods = get_class_methods($this);
        foreach ($methods as $key => $method) {
            if ($key == 0) {
                continue;
            }
            $url = base_url("/api/awork/index?t_code={$method}");
            $listHtml .= " - $key. [<a href='{$url}' target='_blank'>$method</a>]&nbsp;";
            if ($key % 4 == 0) {
                $listHtml .= "<br>";
            }
            if ($method == 'first') {
                break;
            };
        }
        echo $listHtml;
        return false;
    }

    /*************************************************** start *******************************************************/

    /**
     * get current php version
     *
     * @return string
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 15:17
     */
    public function phpVersion() {
        return PHP_VERSION;
    }

    /**
     * get client ip
     *
     * @return mixed|string
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:09
     */
    public function clientIp() {
        return client_ip();
    }

    /**
     * get client dns record
     *
     * @return array|false
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:28
     */
    public function clientDns() {
        return dns_get_record(basename(base_url()));
    }

    /**
     * get client user agent
     *
     * @return array|false
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:28
     */
    public function clientUa() {
        return request()->header('user-agent');
    }

    /***************************************************  end  *******************************************************/

    /**
     * display php info
     *
     * @return JsonResponse
     * <li> true </li>
     * @date 2022/06/25 10:48
     */
    public function phpinfo() {
        if (request('code', '') != 'awork') {
            return $this->fail('invalid code');
        }
        phpinfo();
        exit();
    }

    /**
     * first index
     *
     * @return mixed
     */
    public function first() {
        $methods = get_class_methods($this);
        $method = $methods[1];
        return $this->$method();
    }

}
