
<?php
                    
                    try{
                        $userpanid = $_REQUEST['id'];
                   //echo $userpanid;
                    $servername = "localhost";
                    $username = "u952853138_Hunterits";
                    $password = "Hunter@1988";
                    $dbname = "u952853138_Hunterits";
                    //PDO Connection for Database
                    try {
                        $conn = new PDO("mysql:host = " . $servername . ";dbname =" . $dbname, $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                    
                    $stmant = "DELETE FROM `u952853138_Hunterits`.`detailsip` WHERE `detusr_id` ='$userpanid' ";
                    if($conn->query($stmant) == true){
                        $_SESSION['delusr'] = "Data Deleted Successfully";
                        header('location:add_proxy.php');
                    }
                    else{
                        echo " ";
                    }
                    
                    }
                    catch(PDOException $e){
    echo " " .$e->getMessage();
}
?>