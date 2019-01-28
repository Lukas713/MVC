<?php
/*
 * Front controller
*/

/*Twig autoloader (class autoloader)*/
require '../vendor/autoload.php';
// composer dump-autoload

/*Error and exception handler
http://php.net/manual/en/function.set-error-handler.php
*/
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/*Routing*/
$router = new Core\Router();

//Adds the routes
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);