<?php

namespace Core;

class View {
    /*render a view file

    @param string, view file
    @return void
    */
    public function render($view){

        $file = "../App/Views/$view";   //path relative to Core directory
        if(!is_readable($file)){
            echo $file . ' not found!';
            return;
        }
        require $file;
    }
}