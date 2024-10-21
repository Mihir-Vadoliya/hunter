<?php
$servername = "localhost";
$username = "u952853138_Hunterits";
$password = "Hunter@1988";
$dbname = "u952853138_Hunterits";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}


if(!empty($_POST["super_id"])){
    $users_arr = array();
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM userinfo where super_id = ".$_POST['super_id']; 
    $result = $connect->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            $userid = $row['sn'];
            $name = $row['p_id'];
            $users_arr[] = array("id" => $userid, "name" => $name);
        } 
    }else{ 
        echo '<option value="">Seller ID not available</option>'; 
    } 
}

echo json_encode($users_arr);