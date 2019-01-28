<?php

namespace Core;

use App\Config;
use PDO;


/* Base model */
abstract class Model
{
    /*get the PDO database connection*/
    protected static function connect(){

        static $conn = null;

        if($conn == null){

            $host_db = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME
                . ';charset=utf8';
            $conn = new PDO($host_db, Config::DB_USER, Config::DB_PASSWORD);

            //ses attribute on database handle http://php.net/manual/en/pdo.setattribute.php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $conn;
    }
}