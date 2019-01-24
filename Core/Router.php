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

        e.x. {controller}/{action}
    */
    public function add($route, $params = []){
        //Convert route to regular expression: escape forward slashes
        //e.x. {controller}/{action} into {controller}\/{action}
        $route = preg_replace('/\//', '\\/', $route);

        //convert variables, e.g. {controller}
        //e.x. {controller}\/{action} into (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        //convert variables with custom regular expression
        //e.x. {id:\d+}
        $route  = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //add starting and ending delimeters and case insensitive flag (^, $, i)
        //e.x. (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+) into /^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/i
        $route = '/^' . $route . '$/i';

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
     * @param string $url, The route URL (fixed URL structure)
     * @return boolean, true if found : false otherwise
     *
     * e.x. /employees/new
    */
    public function match($url){

       foreach($this->routes as $route => $param){
            if(!preg_match($route, $url, $matches)){
                continue;
            }
            foreach ($matches as $key => $match){
                if(!is_string($key)){
                    continue;
                }
                $param[$key] = $match;
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