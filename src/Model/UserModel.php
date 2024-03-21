<?php

declare(strict_types = 1);

namespace MyApp\Model;
use MyApp\Entity\User;
use PDO;

class UserModel{
    private PDO $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function getAllUsers():array{
        $sql = "SELECT * FROM User";
        $stmt = $this->db->query($sql);
        $users=[];

        while($row = $stmt->fetch()){
            $users[] = new User($row['id'], $row['email'], $row['lastName'], $row['firstName'], $row['password']);
        }

        return $users;
    }
    public function getOneUser(int $id):?User{
        $sql = "SELECT * from User where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row){
        return null;
        }
        return new User($row['id'], $row['email'], $row['lastName'], $row['firstName'], $row['password']);
       }
       
       public function updateUser(User $user):bool {
        $sql = "UPDATE User SET email = :email, lastname = :lastName, firstName = :firstName, password = :password  WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $user->getLastname(), PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $user->getFirstname(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function createUser(User $user): bool {
        $sql = "INSERT INTO User (email,lastname,firstname,password) VALUES (:email, :lastname, :firstname, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $user->getLastname(), PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $user->getFirstname(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    public function deleteUser(int $id): bool {
        $sql = "DELETE FROM User WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
        }
}