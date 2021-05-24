<?php

if (session_id() == '') {
    $lifetime = 60 * 60 * 24 * 7 * 2;
    //2 weeks in seconds

    session_set_cookie_params($lifetime, '/');
    session_start();
}

if (isset($_SESSION['user'])) {
    header('Location: list_manager/index.php');
}

require_once 'model/User.php';
require_once 'view/header.php';
?>

<main><!-- Home page stuff goes here? Maybe update news?--></main>

<?php require_once 'view/footer.php'; ?>
