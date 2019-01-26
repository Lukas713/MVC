<?php

namespace App\Controllers;
use \Core\View;

class Post extends \Core\Controller {
    /* show the index page
        @return void
    */
    public function index(){
        View::renderTemplate('Post/index.html');
    }

    /*
     * show addNew page
     * @return void
     * */
    public function addNew(){
        echo 'Hello World, I am addNew() action inside Post controller';
    }

    public function edit() {
        echo 'Hello World, I am edit() action inside Post controller and my parameters are: ';
        echo '<hr>';
        print_r($this->routeParams);
        echo '<hr>';
    }


    protected function before()
    {
        echo 'I am invoked before' . '<hr>';
    }

    protected function after()
    {
        echo '<hr>' . 'I am invoked after';
    }
}