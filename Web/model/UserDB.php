<?php
require_once '../model/User.php';

class UserDB
{

    public static function insertUser($user) {
        global $db;
        $query = 'INSERT INTO user (firstName, lastName, email, password)
                  VALUES (:firstName, :lastName, :email, :password)';
        $statement =$db->prepare($query);

        $statement->bindValue(':firstName', $user->getFirstName());
        $statement->bindValue(':lastName', $user->getLastName());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());

        $statement->execute();
        $statement->closeCursor();

        return UserDB::getUser($db->lastInsertId());    //return the proper user object from the new ID
    }

    public static function newEmail($email) {   //return true = email is distinct
        global $db;
        $query = "SELECT email FROM user WHERE email = '$email'";

        $statement = $db->prepare($query);

        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();

        if (count($users) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function userLogin($email, $password) {
        global $db;
        $query = "SELECT id, email, password FROM user WHERE email = '$email' and password = '$password'";

        $statement = $db->prepare($query);

        $statement->execute();
        $loginUser = $statement->fetch();
        $statement->closeCursor();
        
        if ($statement->rowCount() > 0) {
            return UserDB::getUser($loginUser['id']);
        } else {
            return null;
        }
    }

    public static function getUser($id) {
        global $db;
        $query = "SELECT * FROM user WHERE id = '$id'";

        $statement = $db->prepare($query);

        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        return new User($user['firstName'], $user['lastName'], $user['email'], $user['password'], $user['id'], $user['userTypeId'], $user['created'], $user['updated']);
    }
} 
