<?php

class Router{
    /*
     *  Associative array of routes (table of routes)
     *  @var array
     */
    protected $routes = [];

    /*
     * Parameters from matched routes
     * @var array
     */
    protected $params = [];

    /*
        Add route to routing table
        @param string $route, The route URL
        @param array $params, Parameters (controllers, actions ...)
        @return void
    */
    public function add($route, $params){
        $this->routes[$route] = $params;
    }

    /*
     * Get all routes form routing table
     * @return array
     */
    public function getRoutes(){
        return $this->routes;
    }

    /*
     * Match the route to the routes inside routing table, set $params property
     * if route is found
     *
     * @param string $url, The route URL
     * @return boolean, true if found : false otherwise
    */
    public function match($url){
        foreach ($this->routes as $route => $param){
            if($url != $route){
                continue;
            }
            $this->params = $param;
            return true;
        }
        return false;
    }

    /*Get currently matched params
     * @return array
    */
    public function getParams(){
        return $this->params;
    }
}