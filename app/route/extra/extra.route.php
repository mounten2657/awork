<?php
/**
 * extra route
 * @copyright (c) 2012-2020, Hangzhou Awork Tech Co., Ltd.
 * This is NOT a freeware, use is subject to license terms.
 * @package extra.route.php
 * @link http://www.awork.com
 * @author wujun
 * @: extra.route.php 311001 2020-08-24 15:28:54 wujun $
 * */

use core\Router;

/**
 * อโมดยทำษ
 */

Router::get('extra/url', 'extra/ExtraApi/redirect');
Router::post('extra/url', 'extra/ExtraApi/redirect');

