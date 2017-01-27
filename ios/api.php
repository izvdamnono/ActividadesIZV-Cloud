<?php
$time_start = microtime(true);
header('Content-Type: application/json');
require_once('../clases/AutoLoad.php');

$json = file_get_contents('php://input');
$parametros = explode('/', $_GET['url']);

$api = new Api($_SERVER['REQUEST_METHOD'], $json, $parametros, $_GET);
$api->doJob();
echo $api->getResponse();


$time_end = microtime(true);
$time = $time_end - $time_start;
// echo "Process Time: {$time}";