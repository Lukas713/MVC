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
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);

//display routing table
/*
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';
*/

//Match the requested route
$url = $_SERVER["QUERY_STRING"];
if($router->match($url)){
    echo '<pre>';
    echo var_dump($router->getParams());
    echo '</pre>';
}else {
    echo "No routes found for URL: " . $url;
}