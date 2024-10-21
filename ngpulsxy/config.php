<?php
session_start();
$servername = "localhost";
$username = "u952853138_Hunterits";
$pasword = "Hunter@1988";
$dbname = "u952853138_Hunterits";

//PDO Connection for Database
try {
    $conn = new PDO("mysql:host = " . $servername . ";dbname =" . $dbname, $username, $pasword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// try {
//     $conn = new PDO("mysql:host = " . $servername . ";dbname =" . $dbname, $username, $pasword);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     if (isset($conn)) {
//         echo "Connected successfully";
//     }
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
