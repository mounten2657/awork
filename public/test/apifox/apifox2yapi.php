<?php
/**
 * this script is used to generate yapi json from apifox.
 * @usage: php apifox2yapi [project] [group,alias] [regular]
 * @example php apifox2yap api 组班晚辅 v2/tutor/group
 * @author smplote@gmail.com
 * @date 2021.06.31 15:11:13
 */

// merge request
$arg = array_merge($_REQUEST, $_GET, $_POST, $argv ?: []);
$arg[1] = isset($arg[1]) ? $arg[1] : $arg['project'];
$arg[2] = isset($arg[2]) ? $arg[2] : $arg['group'];
$arg[3] = isset($arg[3]) ? $arg[3] : $arg['regular'];

// get help
if (!isset($arg[1]) || (isset($arg[1]) && in_array($arg[1], array('-h', '--help')))) {
    echo PHP_EOL . '@usage: php apifox2yapi [project] [group,alias] [regular]' . PHP_EOL;exit;
}

// get params
$params = [
    'project'     => isset($arg[1]) ? $arg[1] : '',
    'group'       => isset($arg[2]) ? $arg[2] : '',
    'regular'     => isset($arg[3]) ? $arg[3] : '',
];

// run main
main($params);

/**
 * @param $params
 * @return bool
 */
function main($params)
{
    $url = 'http://127.0.0.1:4523/export/openapi?projectId=389968';
    $project = $params['project'] ?: '';
    $regular = $params['regular'] ?: '';
    $group = $params['group'] ?: '';
    $group = explode(',', $group, 2);
    if (!isset($group[1])) {
        $group[1] = $group[0];
    }
    list($group, $alias) = $group;

    // get result
    $res = curlGet($url);
    // replace result
    $res = str_replace("/edu/v2/api", '', $res);
    $res = str_replace("$project/$group", $alias, $res);
    $res = json_decode($res, true) ?: $res;
    if ($res && is_array($res)) {
        foreach ($res as $key => &$val) {
            if ('tags' == $key) {
                $val = [['name' => $alias]];
            }
            if ('paths' == $key) {
                foreach ($val as $k => $v) {
                    if (false === strpos($k, $regular)) {
                        unset($val[$k]);
                    }
                }
            }
        }
    }
    $out = json_encode($res, JSON_UNESCAPED_UNICODE);
    echo $out;
    file_put_contents('./tmp.json', $out);
    return true;
}

/**
 * curl get
 * @param $url
 * @return bool|string
 */
function curlGet($url)
{
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
}
