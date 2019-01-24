<?php

/*
 * Front controller
*/
require "../App/Controllers/Post.php";

/*Routing*/
require "../Core/Router.php";

$router = new Router();

//Adds the routes
$router->add('', ['controller' => 'home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);