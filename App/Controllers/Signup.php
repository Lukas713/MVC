<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 30/01/2019
 * Time: 14:03
 */

namespace App\Controllers;

use \Core\View;
use \App\Models\User;


class Signup extends \Core\Controller
{
    /*method that displays view

    @return void
    */
    public function index(){
        View::render('Signup/register.html');
    }

    public function create(){
        $user = new User($_POST);
        $user->save();

        View::render('Signup/success.html');
    }
}