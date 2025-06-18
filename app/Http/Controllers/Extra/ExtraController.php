<?php

namespace App\Http\Controllers\Extra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraController extends Controller {

    /**
     * get sha256 or sha512 string
     *
     * @return string
     * <li> true </li>
     * author: smplote@gmail.com
     * date: 2025/04/29 15:01
     */
    public function sha(Request $request): string {
        $code = $request->get('code', '');
        $type = $request->get('type', 'sha256');
        if (!in_array($type, ['sha256', 'sha512'])) {
            return $this->fail('不支持的加密算法');
        }
        $str = hash($type, $code);
        return $this->success($str);
    }

    /**
     * 重启 gunicorn
     *
     * @param Request $request
     * @return string
     * <li> true </li>
     * author: smplote@gmail.com
     * date: 2025/06/18 16:04
     */
    public function rgu(Request $request): string {
        $code = $request->get('code', '');
        $md5 = md5(config('app.key'));
        if ($md5 != $code) {
            return $this->fail('Invalid Request!');
        }
        $p = $request->get('p', '');
        $sh = system('sudo /opt/shell/init/init_flask.sh >>/tmp/init_flask.log 2>&1');
        return $this->success(['p' => $p, 'sh' => $sh]);
    }

}
