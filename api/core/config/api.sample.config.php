<?php
/**
 * Created by PhpStorm.
 * Author: ershov-ilya
 * Website: http://ershov.pw/
 * Date: 06.02.2015
 * Time: 10:54
 */

define('API_ROOT_PATH', '/var/www/absolute_path_here');
define('API_ROOT_URL', 'http://absolute_web_url_here');

define('API_CORE_PATH', API_ROOT_PATH.'/core');
define('API_CORE_URL', API_ROOT_URL.'/core');

define('API_LOG_PATH', API_ROOT_PATH.'/logs/log.txt');
function logMessage($content)
{
    $date = date("m.d.Y G:i:s T ");
    $content = $date.' '.$content."\n";
    file_put_contents(API_LOG_PATH, $content, FILE_APPEND);
}