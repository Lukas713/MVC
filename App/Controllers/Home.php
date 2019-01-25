<?php

namespace App\Controllers;

class Home extends \Core\Controller {

    /* show index page inside controller

    @return void

    */
    public function index(){
        echo 'Hello World, I am index page inside Home controller';
    }

    protected function after()
    {

        echo '<hr>' . 'I am invoked after';
    }

    protected function before()
    {
        echo 'I am invoked before' . '<hr>';
    }
}