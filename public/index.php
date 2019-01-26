<?php
/*
 * Front controller
*/

/*Twig autoloader*/
require_once dirname(__DIR__) . '\vendor\vendor\autoload.php';
//Twig_Autoloader::register();  <---- not needed in Twig 2.0

/*Class autoloader*/
spl_autoload_register(function($class){ //load class e.x. Core\Router();
    $root = dirname(__DIR__); //parent directory    e.x. C:/xampp/htdocs/MVC
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php'; //e.x. C:/xampp/htdocs/MVC/Core/Router.php
    if(is_readable($file)){ //if file exists and its readable
        //require that path
        require  $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

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