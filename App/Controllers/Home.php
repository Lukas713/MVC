<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {

    /* show index page inside controller

    @return void

    */
    public function index(){
        View::renderTemplate('Home/index.html', [
                'name' => 'lukas',
                'colour' => 'black',
                'cars' => ['polo', 'audi', 'bmw']
            ]);


    }

    protected function before()
    {
        echo 'I am method that is invoked before' . '<hr>';
    }

    protected function after()
    {

        echo '<hr>' . 'I am method that is invoked after';
    }
}