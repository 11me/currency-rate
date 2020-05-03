<?php

//$uri = $_SERVER["REQUEST_URI"];
//
//var_dump(pathinfo($uri));

// show erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/app/Router.php');

$router = new Router();
$router->start();
