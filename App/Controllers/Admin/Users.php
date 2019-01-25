<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 25/01/2019
 * Time: 14:02
 */

namespace App\Controllers\Admin;


class Users extends \Core\Controller
{
    protected function before(){
        echo 'Hello World, I am before() method in User class';
        echo '<hr>';
    }

    protected function after(){
        echo '<hr>';
        echo 'Hello World, I am after() method in User class';
    }

    public function index(){
        echo 'This is index page of the Admin that visits User page!';
    }
}