<?php

namespace App\Http\Middleware;

use App\Services\CacheKeyService;
use Closure;
use Illuminate\Http\Request;

/**
 * 日志记录中间件
 *
 * Class AccessLog
 * @package App\Http\Middleware
 */
class AccessLogMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $response = $next($request);
        if (!empty($response)) {
            $sUserAgent = $request->header('user_agent');
            // 特定爬虫实行阻断拦截
            if (false === $this->checkSpiderDeny($sUserAgent)) {
                die('Bad Request : 542');
            }
            $url = base_url(false) . $request->getPathInfo();
            if ($request->getQueryString()) {
                $url .= '?' . $request->getQueryString();
            }
            $aRep = $response->getContent();
            $aRep = json_decode($aRep, true) ?:
                substr(str_replace('  ', '', $aRep), 0, 1024);
            $iCode = $response->getStatusCode();
            // 获取基础数据
            $data = [
                'url' => $url,
                'status_code' => $iCode,
                'referer' => $request->header('referer', ''),
                'user_agent' => $sUserAgent,
                'ip' => client_ip(),
                'request' => $request->all(),
                'response' => $aRep,
            ];
            glog('access/access')->info("[ACCESS_LOG][{$iCode}]", $data);
        }
        return $response;
    }

    /**
     * 检查是否为阻断爬虫
     *
     * @param $sUserAgent
     * @return bool
     * <li> true </li>
     * @date 2022/05/27 22:12
     */
    public function checkSpiderDeny($sUserAgent) {
        // 特定爬虫实行阻断拦截
        $aConfig = config('spider.deny_list');
        foreach ($aConfig as $item) {
            if (false !== stripos($sUserAgent, $item['name'])) {
                if (empty($item['time'])) {
                    return false;
                }
                $sCacheKey = CacheKeyService::o()->getCacheKey(CacheKeyService::SPIDER_DENY, $item['name']);
                if (empty(gredis()->setnx($sCacheKey, time()))) {
                    return false;
                }
                // 设置阻断时间
                gredis()->expire($sCacheKey, $item['time']);
            }
        }
        return true;
    }

}
