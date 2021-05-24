<?php

if (session_id() == '') {
    $lifetime = 60 * 60 * 24 * 7 * 2;
    //2 weeks in seconds

    session_set_cookie_params($lifetime, '/');
    session_start();
}

$controllerChoice = filter_input(INPUT_POST, 'controllerRequest');

if ($controllerChoice == null) {
    $controllerChoice = filter_input(INPUT_GET, 'controllerRequest');

    if ($controllerChoice == null) {
        $controllerChoice = 'user_add';
    }
}

require_once '../model/database.php';
require_once '../model/User.php';
require_once '../model/UserDB.php';

switch ($controllerChoice) {
    case 'user_add':
        include 'user_add.php';
        break;
    case 'user_add_process':
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = strtolower(filter_input(INPUT_POST, 'email')); //to lower to simplify distict email addresses
        $password = filter_input(INPUT_POST, 'password');

        $distinct = UserDB::newEmail($email);

        if ($distinct) {
            $newUser = new User($firstName, $lastName, $email, $password);

            $user = UserDB::insertUser($newUser);

            $_SESSION['user'] = serialize($user);

            include '../index.php';     //TODO:forward to index for now, default to ToDo list page when implemented
        } else {
            $emailError = true;
            include 'user_add.php';
        }
        break;
    case 'user_login':
        include 'user_login.php';
        break;
    case 'user_login_process':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        $user = UserDB::loginUser($email, $password);

        if ($user !== null) {
            $_SESSION['user'] = serialize($user);
            $_SESSION['userId'] = $user->getId();

            header('Location: ../list_manager/index.php');
        } else {
            $badLogin = true;
            include 'user_login.php';
        }
        break;
    case 'user_logout':
        session_destroy();
        include '../index.php';
        break;
    case 'user_profile':
        $user = unserialize($_SESSION['user']);

        include 'user_profile.php';
        break;
    case 'user_profile_process':
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $user = unserialize($_SESSION['user']);

        UserDB::updateUser($user->getId(), $firstName, $lastName, $email, $password);

        //login user to reset session variable for user
        $user = UserDB::loginUser($email, $password);

        $_SESSION['user'] = serialize($user);

        header('Location: ../list_manager/index.php');

        break;
    case 'user_delete':
        $password = filter_input(INPUT_POST, 'password');
        $user = unserialize($_SESSION['user']);

        if ($user->getPassword() == $password) {
            include 'user_delete.php';
        } else {
            $badDeletePassword = true;
            include 'user_profile.php';
        }

        break;
    case 'user_delete_process':
        $user = unserialize($_SESSION['user']);

        UserDB::deleteUser($user);

        session_destroy();
        include '../index.php';
        break;
    case 'user_password_change_process':
        $passVerify1 = filter_input(INPUT_POST, 'passVerify1');
        $passVerify2 = filter_input(INPUT_POST, 'passVerify2');
        $newPassword = filter_input(INPUT_POST, 'newPassword');

        $user = unserialize($_SESSION['user']);

        $badVerifyPassword = false;

        if ($passVerify1 == $user->getPassword() && $passVerify1 == $passVerify2) {
            UserDB::updateUser($user->getId(), $user->getFirstName(), $user->getLastName(), $user->getEmail(), $newPassword);

            $user = UserDB::loginUser($user->getEmail(), $newPassword);

            $_SESSION['user'] = serialize($user);

            header('Location: ../list_manager/index.php');
        } else {
            $badVerifyPassword = true;
            include 'user_profile.php';
        }

        break;
}
