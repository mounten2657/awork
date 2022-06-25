<?php

namespace App\Services;

class CacheKeyService extends BaseService {

    /** @var string 爬虫阻断缓存 - 5 min */
    const SPIDER_DENY = 'spider_deny:%s';

    /**
     * 获取缓存键名
     *
     * @param $sKey
     * @param array $aVal
     * @return string
     * @author wuj@igancao.com
     * @date 2022/05/16 16:38
     */
    public function getCacheKey($sKey, $aVal = []) {
        return vsprintf($sKey, $aVal);
    }

}
