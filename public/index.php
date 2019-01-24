<?php
/*
 * Front controller
*/

spl_autoload_register(function($class){ //load class e.x. Core\Router();
    $root = dirname(__DIR__); //parent directory    e.x. C:/xampp/htdocs/MVC
    echo "<hr>" . $root . "<hr>";
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php'; //e.x. C:/xampp/htdocs/MVC/Core/Router.php
    if(is_readable($file)){ //if file exists and its readable
        //require that path
        require  $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});

/*
 *
 * */

/*Routing*/
$router = new Core\Router();

//Adds the routes
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);