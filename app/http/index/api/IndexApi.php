<?php

namespace app\http\index\api;

use app\http\BaseApi;
use app\http\index\facade\IndexFacade;

class IndexApi extends BaseApi
{

    /**
     * generate bat file for version
     */
    public function generateBat()
    {
        $data = sapp()->request()->get('text');
        $data = array_filter(array_unique(explode(',', $data)));
        if (empty($data)) {
            return sapp()->response()->fail('Invalid input.');
        }
        $batStr = IndexFacade::getBat($data);
        $data = array('file' => $data, 'bat' => $batStr);

        return sapp()->response()->ok($data);
    }


    /**
     * download bat
     * @return bool
     */
    public function downloadBat()
    {
        $data = sapp()->request()->get('text');
        $data = array_filter(array_unique(explode(',', $data)));
        if (empty($data)) {
            return sapp()->response()->fail('Invalid input.');
        }

        $batStr = IndexFacade::getBat($data);
        $filename = 'version_'.date('Ymd_His').'.bat';

        return sapp()->download()->setOption(array(
            'name' => $filename,
            'content' => $batStr
        ))->down();
    }




}