<?php

if(!isset($_SESSION)){
    session_start();
    ob_start();
}


$servername = "localhost";
// $username = "u952853138_Hunterits";
// $password = "Hunter@1988";
// $dbname = "u952853138_Hunterits";

$username = "root";
$password = "";
$dbname = "htr_2";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>