<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 30/01/2019
 * Time: 15:04
 */

namespace App\Models;

use PDO;

class User extends \Core\Model
{
    public function __construct($data)
    {
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
    }

    public function save() {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $conn = static::connect();

        $stmt = $conn->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
        $stmt->bindValue("password", $passwordHash, PDO::PARAM_STR);

        $stmt->execute();
    }
}