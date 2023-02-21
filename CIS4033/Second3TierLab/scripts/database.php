<?php
    $dsn = 'mysql:host=localhost;dbname=my_first_3_tier_app';
    $username = 'kermit';
    $db_password = 'sesame';

    try {
        $db = new PDO($dsn, $username, $db_password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>