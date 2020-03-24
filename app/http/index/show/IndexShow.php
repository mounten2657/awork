<?php

namespace app\http\index\show;

use app\http\BaseShow;

class IndexShow extends BaseShow
{

    /**
     * 首页
     */
    public function index()
    {
        $aworkVersion = config('awork_version');

        $this->display([
            'awork_version' => $aworkVersion,
        ]);
    }

    /**
     * CNZZ 统计测试
     */
    public function cnzz()
    {
        $this->display();
    }

}