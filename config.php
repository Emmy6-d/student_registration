<?php

$host = "localhost";
$dbname = "student_registration";
$username = "root";
$password = "";
$mailFrom = "no-reply@bluebridge.local";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

    $pdo->exec(
        "ALTER TABLE students
         ADD COLUMN IF NOT EXISTS student_id CHAR(8) NULL UNIQUE AFTER id"
    );

} catch (PDOException $e) {

    die("Database connection failed.");

}
?>