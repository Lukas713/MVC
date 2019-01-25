<?php

namespace Core;

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

    /* follow the route
     * create controller object and invoke action method from URL if exists
     * @param string, The URL route
     * @return void
     * */
    public function dispatch($url){
        $url = $this->removeQueryStringVariable($url);

        if(!$this->match($url)){    //check if URL got corresponding route
            echo "Error 404!";
            return;
        }
        //if user knows our logic for invoking action filters
        if(preg_match('/action$/i', $this->params['action']) != 0){
            throw new \Exception("Action $this->params['action'] cant be called directly from URL!");
        }

        //take controller and convert it to corresponding string format
        $controller = $this->params['controller'];
        $controller = $this->convertToStudyCase($controller);
        $controller = $this->getNamespace() . $controller;

        if(!class_exists($controller)){ //check if controller class exists
            echo "Class " . $controller . " does not exists!";
            return;
        }
        //create controller object, extract action, convert it to corresponding string format
        $controllerObject = new $controller($this->params);

        $action = $this->params['action'] . '@Action';  //set name to action@Action to invoke __call
        $action = $this->convertToCamelCase($action);

        $controllerObject->$action();   //invoke action and class that are searched in URL
    }

    /*
     * replace '-' with ' '
     * set each first letter into upper letter
     * replace ' ' with ''
     * @param string
     * @return string
     *
     * e.x. new-employee into NewEmployee
     * */
    protected function convertToStudyCase($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /*
     * convert string into study case
     * convert just first letter into lower letter
     * @param string
     * @return string
     *
     * e.x. add-new into addNew
     */
    protected function convertToCamelCase($string){
        return lcfirst($this->convertToStudyCase($string));
    }

    /*
     * removes query string variables from URL
     * but still can access then in $_GET global variable
     *
     * mvc.com/post/index?page=1  ----->  post/index?page=1  -----> post/index
     *
     * @param string
     * @return string
     * */
    protected function removeQueryStringVariable($url){
        if($url != ''){
            $parts = explode('&', $url, 2); //split url, first half is before & and second is after
            //if first half contains equality sign, URL is  e.x. empty mvc.com?page=2 = ''
            if(strpos($parts[0], '=') === false){
                $url = $parts[0];
            }else {
                $url = '';
            }
        }
        return $url;
    }

    /*get the namespace for the controller class
    namespace defined in the route parameters is added if presented

    @return string  request URL */
    protected function getNamespace(){
       $namespace = '\App\Controllers\\';

       if(array_key_exists('namespace', $this->params)){
           $namespace = $namespace . $this->params['namespace'] . '\\';
       }
       return $namespace;
    }

}