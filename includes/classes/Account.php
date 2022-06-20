<?php

class Account
{
    private $conn;
    private $errorArray = array();

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function register($fn, $ln, $un, $em, $em2, $pw, $pw2)
    {
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUsername($un);
        $this->validateEmail($em, $em2);
        $this->validatePassword($pw, $pw2);

        if(empty($this->errorArray)) {
            return $this->insertUserDetials($fn, $ln, $un, $em, $pw);
        }
        return false;

    }

    private function insertUserDetials($fn, $ln, $un, $em, $pw)
    {
        $pw = hash("sha512", $pw);

        $query = $this->conn->prepare("INSERT INTO users (
                   firstName, lastName, username, email, password
                   ) VALUES (:fn, :ln, :un, :em, :pw)
                   ");
        $query->bindValue(":fn", $fn);
        $query->bindValue(":ln", $ln);
        $query->bindValue(":un", $un);
        $query->bindValue(":em", $em);
        $query->bindValue(":pw", $pw);

        return $query->execute();
    }

    private function validateFirstName($fn)
    {
        if(strlen($fn) < 2 || strlen($fn) > 45) {
            $this->errorArray[] = Constants::$firstNameCharacters;
        }
    }

    private function validateLastName($ln)
    {
        if(strlen($ln) < 2 || strlen($ln) > 45) {
            $this->errorArray[] = Constants::$lastNameCharacters;
        }
    }

    private function validateUsername($un)
    {
        if(strlen($un) < 5 || strlen($un) > 255) {
            $this->errorArray[] = Constants::$usernameCharacters;
            return;
        }
        $query = $this->conn->prepare("SELECT * FROM users WHERE username=:un");
        $query->bindValue(":un", $un);
        $query->execute();

        if($query->rowCount() != 0) {
            $this->errorArray[] = Constants::$usernameTaken;
        }
    }

    private function validateEmail($em, $em2)
    {
        if($em != $em2) {
            $this->errorArray[] = Constants::$emailsDontMatch;
            return;
        }
        if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $this->errorArray[] = Constants::$emailInvalid;
            return;
        }

        $query = $this->conn->prepare('SELECT * FROM users WHERE email=:em');
        $query->bindValue(':em', $em);
        $query->execute();

        if ($query->rowCount() != 0) {
            $this->errorArray[] = Constants::$emailTaken;
        }
    }
    private function validatePassword($pw, $pw2)
    {
        if($pw != $pw2) {
            $this->errorArray[] = Constants::$passwordsDontMatch;
            return;
        }
        if(strlen($pw) <= 12) {
            $this->errorArray[] = Constants::$passwordLength;
        }
    }



    public function getError($error)
    {
        if(in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }
}