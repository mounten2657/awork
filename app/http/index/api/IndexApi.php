<?php

namespace app\http\index\api;

use app\http\BaseApi;

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
        $batStr = $this->_getBat($data);
        $data = array('file' => $data, 'bat' => $batStr);
        sapp()->response()->ok($data);
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

        $batStr = $this->_getBat($data);
        $filename = 'version_'.date('Ymd_His').'.bat';

        return sapp()->download()->setOption(array(
            'name' => $filename,
            'content' => $batStr
        ))->down();
    }

    /**
     * get bat file content
     * @param $data
     * @return string
     */
    private function _getBat($data)
    {
        $droot = 'D:\\code\\ihtml\\';
        $path = array();
        foreach ($data as $key => $val) {
            if (!strpos($val, '/')) {
                $path[] = '';
                continue;
            }
            $path[] = strtr($val, array(strrchr($val, '/') => ''));
        }
        $path = array_filter(array_unique($path));

        $pathStr = '';
        foreach ($path as $p) {
            $pathStr .= 'md ' . strtr($p, '/', '\\') . PHP_EOL;
        }

        $fileStr = '';
        foreach ($data as $f) {
            $f = strtr($f, '/', '\\');
            $fileStr .= "copy /y {$droot}{$f} $f ". PHP_EOL;
        }

        $batStr  = "";
        $batStr .= "@echo off" . PHP_EOL . PHP_EOL;
        $batStr .= "echo start ..." . PHP_EOL;
        $batStr .= "D: && cd D:\document" . PHP_EOL;
        $batStr .= "md var\www\html" . PHP_EOL;
        $batStr .= "cd var\www\html" . PHP_EOL . PHP_EOL;
        $batStr .= "echo mkdir ..." . PHP_EOL;
        $batStr .= "{$pathStr}" . PHP_EOL;
        $batStr .= "echo copy file ..." . PHP_EOL;
        $batStr .= "{$fileStr}" . PHP_EOL;
        $batStr .= "pause" . PHP_EOL;

        return $batStr;
    }


}