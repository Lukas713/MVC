<?php

class Post {

    /* show the index page
        @return void
    */
    public function index(){
        echo 'Hello World, I am index action inside Post controller';
    }

    /*
     * show addNew page
     * @return void
     * */
    public function addNew(){
        echo 'Hello World, I am addNew action inside Post controller';
    }
}