<?php

namespace App\Domain\User;

class User{
    private UserId $id;
    private string $name;
    private string $email;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    private function validateEmail ($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
}