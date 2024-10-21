<?php
session_start();
$servername = "localhost";
$username = "u975789672_elite";
$pasword = "N.4eZ+xXx+Y]";
$dbname = "u975789672_elite";

//PDO Connection for Database
try {
    $conn = new PDO("mysql:host = " . $servername . ";dbname =" . $dbname, $username, $pasword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
