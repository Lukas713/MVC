<?php
/**
 * Created by PhpStorm.
 * User: Korisnik
 * Date: 30/01/2019
 * Time: 15:04
 */

namespace App\Models;

use PDO;

class Users extends \Core\Model
{
    /*holds errors from input
        @var array
    */
    public $errors = [];

    public function __construct($data)
    {
        foreach ($data as $key => $value){
            $this->$key = $value;
        }
    }

    public function save() {

        $this->validate();
        if(!empty($this->errors)){
            return false;
        }

        $passwordHash = password_hash($this->repeat_password, PASSWORD_DEFAULT);
        $conn = static::connect();

        $stmt = $conn->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
        $stmt->bindValue("password", $passwordHash, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /*validate property values

        @return void
    */
    public function validate(){

        //validate email adress
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false ){
            $this->errors[] = 'Invalid email';
        }

        //check if email already eists
        if($this->emailExists($this->email)){
            $this->errors[] = 'Email is already in use';
        }

        //validate repeat password
        if($this->password != $this->repeat_password){
            $this->errors[] = 'Passwords must match';
        }

       /* if(strlen($this->password) < 6){
            $this->errors[] = 'Passwords must have at least 6 numbers';
        }*/

        //validate password format: letters
        if(preg_match('/.*[a-z]+.*/i', $this->password) == 0){
            $this->errors[] = 'Passwords must contains at least one letter';
        }

        //validate password format: numbers
        //if(preg_match('/.*\d+.*/i', $this->password) == 0){
          //  $this->errors[] = 'Passwords must contains at least one number';
        //}
    }

    /* Check if user email is already taken

        @return boolean
    */
    protected function emailExists($email){
        $conn = static::connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue("email", $email, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() != 0){ //user exists
            return true;
        }
        return false;
    }
}