<?php

/*
 * Front controller
*/
/*Routing*/
require "../Core/Router.php";

$router = new Router();

//Adds the routes
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('admin/{controller}/{action}');


//Match the requested route
$url = $_SERVER["QUERY_STRING"];
if($router->match($url)){   //e.x.  /employees/new

    echo '<pre>';
    print_r($router->getRoutes());

    echo "<hr>";

    echo var_dump($router->getParams());
    echo '</pre>';

}else {
    echo "No routes found for URL: " . $url;
    echo '<hr>';
    echo '<pre>';
    print_r($router->getRoutes());

    echo "<hr>";

    echo var_dump($router->getParams());
    echo '</pre>';
}