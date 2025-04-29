<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 接口成功返回
     *
     * @param array $data
     * @param string $msg
     * @param integer $code
     * @return \Illuminate\Http\JsonResponse
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:38
     */
    public function success($data = [], $msg = 'success', $code = 0) {
        $data = ['code' => $code, 'msg' => $msg, 'data' => $data];
        return $this->jsonReturn($data);
    }

    /**
     * 接口失败返回
     *
     * @param string $msg
     * @param integer $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:39
     */
    public function fail($msg = 'fail', $code = 9999, $data = []) {
        $data = ['code' => $code, 'msg' => $msg, 'data' => $data];
        return $this->jsonReturn($data);
    }

    /**
     * 接口 json 返回
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse | string
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/25 11:41
     */
    public function jsonReturn($data) {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        //return response()->json($data);
    }

}
