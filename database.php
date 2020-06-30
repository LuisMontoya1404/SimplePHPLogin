<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'php-login';
    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $error) {
        die("Connection failed: ".$error->getMessage());
    }
?>