<?php
// FRONT CONTROLLER
// 1. ОБЩИЕ НАСТРОЙКИ
require 'vendor/autoload.php';
session_start();
ini_set('display_errors', 1);
error_reporting(1);
// 2. ПОДКЛЮЧЕНИЕ ФАЙЛОВ СИСТЕМЫ
define('ROOT', dirname(__FILE__));
require_once ROOT . '/components/Router.php';
require_once ROOT . '/components/Db.php';

// 3. ВЫЗОВ ROUTER
$router = new Router();
$router->run();





