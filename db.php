<?php

$host = 'localhost'; // конфиги для подключения к БД
$dbname = 'inline_blog';
$username = 'root';
$password = 'root';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}