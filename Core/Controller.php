<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 25/01/2019
 * Time: 11:38
 */

namespace Core;

/*
 * Base controller
 * */
abstract class Controller
{
    /*
     * parameters from matched route
    */
    protected $routeParams = [];

    /*
     * constructor
     * @param array $routeParams, Parameters from the root
     * @return void
    */
    public function __construct($routeParams)
    {
        $this->routeParams = $routeParams;
    }

    /*
     * magic methods is invoked at the end of the dispatcher
     * invoke method before desired action
     * invoke desired action
     * invoke method after desired action
     * @param string & array
     * @return void
     * */
    public function __call($name, $arguments)
    {
        $method = preg_replace('/@Action/', '', $name);
        if(!method_exists($this, $method)){
            echo 'Action does not exist in ' . get_class($this) . ' class!';
            return;
        }

        if($this->before() !== false){
            call_user_func([$this, $method], $arguments);
            $this->after();
            return;
        }
        echo 'I am sorry, you fucked up something!';
    }

    protected function after(){

    }

    protected function before(){

    }
}