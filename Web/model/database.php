<?php
$dsn = 'mysql:host=jordan1.nritweb.com;dbname=sluiterj_AppsDev;charset=utf8;';
$username = 'sluiterj_root';
$password = 'makelikehorseturdsandhitthetrail';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}
