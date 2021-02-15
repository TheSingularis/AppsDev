<?php
$dsn = 'mysql:host=150.15.0.21;dbname=AppsDev;charset=utf8;';
$username = 'root';
$password = 'makelikehorseturdsandhitthetrail'; //BlindedByTheLight1!

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}
