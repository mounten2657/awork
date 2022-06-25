<?php

namespace App\Http\Controllers\Awork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AworkController extends Controller {

    /**
     * awork jump list
     *
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/25 10:47
     */
    public function index(Request $request) {
        // jump to target method
        $target = $request->get('t_code', 'index');
        if ($target != 'index') {
            return $this->success($this->$target());
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
     * get client ip
     *
     * @return mixed|string
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/25 11:09
     */
    public function getClientIp() {
        return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }

    /**
     * get client dns record
     *
     * @return array|false
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/25 11:28
     */
    public function getClientDns() {
        return dns_get_record(basename(base_url()));
    }

    /**
     * get client user agent
     *
     * @return array|false
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/25 11:28
     */
    public function getClientUa() {
        return request()->header('user-agent');
    }

    /***************************************************  end  *******************************************************/

    /**
     * display php info
     *
     * @return bool
     * <li> true </li>
     * @date 2022/06/25 10:48
     */
    public function phpinfo() {
        return phpinfo();
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
