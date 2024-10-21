<?php
include('database/config.php'); 

try{
  if (isset($_POST['addnew_ip'])) {
    $panuser = $_POST['selectUser'];
    $panfields = $_POST['IPaddress'];
     if(isset($_SESSION['pan_id'])){
        $loginsuper = $_SESSION['pan_id'];
        
    }
   
  $panlength = strlen($panfields);
      for($i = 0; $i<=$panlength;$i++){
            if($panfields[$i] == ":"){
                 $stringIP= substr($panfields,0,$i);
                 //echo $stringIP."<br/>";
                 break;
            }
      }
      $panfields = substr($panfields,($i+1),$panlength);
      //echo $panfields."<br/>";
      for($j = 0; $j<=$panlength;$j++ ){
          if($panfields[$j] == ":"){
                 $stringPort= substr($panfields,0,$j);
                 //echo $stringPort."<br/>";
                 break;
            }
      }
      $panfields = substr($panfields,($j+1),$panlength);
      //echo $panfields."<br/>";
      for($k = 0; $k<=$panlength;$k++ ){
          if($panfields[$k] == ":"){
                 $stringUserName= substr($panfields,0,$k);
                // echo $stringUserName."<br/>";
                 break;
            }
      }
     $panfields = substr($panfields,($k+1),$panlength);
      //echo $panfields."<br/>";
    
     $stmnt = "INSERT INTO `u952853138_Hunterits`.`detailsip`(`detusr_id`,`detsuper_key`,`detusr_key`,`detusr_ip`,`detusr_port`,`detusr_pass`, `detusr_name`) VALUES ('','$loginsuper','$panuser','$stringIP','$stringPort','$panfields','$stringUserName')";
     $result = $conn->query($stmnt);
     if (!empty($result)) {
                 $_SESSION['success'] = "<p class='ms-5' style='color:green;'> Data Inserted Successfully..</p>";               
                header("Location:add_proxy.php");
            } else {
                $_SESSION['fail'] = "<p style='color:red;'> Data Inserted Failed..</p>";
                header("Location:add_proxy.php");
            }
    }
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}