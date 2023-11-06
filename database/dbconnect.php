<?php

session_start(); // Start session to store certain data

$host = "localhost"; // Put here your domain name. For example: "localhost".
$username = "root"; // Put your SQL username
$password = ""; // Put your sql password here
$dbname = "code_ju1"; // Don't change this unless you're modifying the database name
$dsn = "mysql:host=$host;dbname=$dbname"; // Don't change this

try {
    $pdo = new PDO($dsn, $username, $password); // Try to connect to the sql database
} catch (PDOException $e) { // If there is an error
    echo $e->getMessage(); // print the error message
}

?>