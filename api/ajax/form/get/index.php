<?php
/**
 * Created by PhpStorm.
 * Author:   ershov-ilya
 * GitHub:   https://github.com/ershov-ilya/
 * About me: http://about.me/ershov.ilya (EN)
 * Website:  http://ershov.pw/ (RU)
 * Date: 10.08.2015
 * Time: 11:00
 */

header("Access-Control-Allow-Origin: http://billing.hostconfig.ru");

// Errors control
header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set("display_errors", 1);
if(isset($_GET['t'])) define('DEBUG', true);
defined('DEBUG') or define('DEBUG', false);
$response=array(
    'data' => array()
);

/* MODX
------------------------------------------------------------------- */
//defined('MODX_API_MODE') or define('MODX_API_MODE', true);
//require_once('../../../../../../index.php');


/* CONFIG
------------------------------------------------------------------- */
require_once('../../../core/config/api.private.config.php');
require_once(API_CORE_PATH.'/class/restful/restful.class.php');
require_once(API_CORE_PATH.'/class/database/database.class.php');
require_once(API_CORE_PATH.'/config/pdo.private.config.php');

/* @var modX $modx*/

try {
    $rest = new RESTful('get_form','id,idperson,date_hired,fio,idrequest,idrequest2,type,bank,numinstall,coast,coast2,status,idbpo,city');
	
	$db=new Database($pdoconfig);
	$table=$db->getTableWhere('requesttable','',$rest->data);
	
	$response['data']=$table;
}
catch(Exception $e){
    $response['message']=$e->getMessage();
    $response['code']=$e->getCode();
}

require_once(API_CORE_PATH.'/class/format/format.class.php');
if(DEBUG) print Format::parse($response, 'php');
else  print Format::parse($response, 'json');
/**/