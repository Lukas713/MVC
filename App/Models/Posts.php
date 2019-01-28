<?php

namespace App\Models;

use PDO;

class Posts extends \Core\Model {

    /*get all posts as assoc array*/
    public static function getAll(){

        try {
            $conn = static::connect(); //use method inside extended class

            $stmt = $conn->query("SELECT * from posts");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }
}