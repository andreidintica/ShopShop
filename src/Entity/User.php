<?php

declare(strict_types = 1);

namespace MyApp\Entity;

class User{
    private ?int $id = null;
    private string $email;
    private string $lastName;
    private string $firstName;
    private string $password;

    public function __construct(?int $id, string $email, string $lastName, string $firstName, string $password){
        $this->id = $id;
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->password = $password;
    }

    public function getId():?int{
        return $this->id;
    }

    public function setId(?int $id):void{
        $this->id = $id;
    }

    public function getEmail():?string{
        return $this->email;
    }

    public function setEmail(string $email):void{
        $this->email = $email;
    }

    public function getLastName():?string{
        return $this->lastName;
    }

    public function setLastName(string $lastName):void{
        $this->lastName = $lastName;
    }

    public function getFirstName():?string{
        return $this->firstName;
    }

    public function setFirstName(string $firstName):void{
        $this->firstName = $firstName;
    }

    public function getPassword():?string{
        return $this->password;
    }

    public function setPassword(string $password):void{
        $this->password = $password;
    }
}