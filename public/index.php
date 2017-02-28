<?php

use vendor\core\Router;

/* -------------------------------- Точка входа на сайт -------------------------------*/


require '../vendor/autoload.php';
require '../vendor/components/Pagination.php';
require '../vendor/components/Translit.php';

define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'main');

session_start();

$query = $_SERVER['QUERY_STRING'];

/*Маршруты по умолчанию*/

Router::add('^$', ['controller' => 'Article', 'action' => 'index']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/page-/?(?P<parameter>[0-9]+)?$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<parameter>[a-zA-Z0-9\-]+)?$');
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');



/*определяем текущий маршрут*/

Router::dispatch($query);

