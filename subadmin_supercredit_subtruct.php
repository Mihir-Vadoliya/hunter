<?php 
include('database/config.php'); 
include('sub_admin_validate_login.php');
date_default_timezone_set("Asia/Calcutta");

try {
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
     $add_credit = $_POST['num'];
     $super_seller_id = $_POST['sn'];
     $super_name = $_POST['uid'];
        if (isset($_SESSION['subid'])){
            $admin_name = $_SESSION['subid'];
            $todaydate =date('Y-m-d h:i:sa');
            $querycredit = "SELECT * FROM `u952853138_Hunterits`.`sub_admin` where `san` = '$admin_name'";
            $resultscredit = $conn->prepare($querycredit);
            $resultscredit->execute();
            $countcredit = $resultscredit->rowCount();
            $rowcredit = $resultscredit->fetch(PDO::FETCH_ASSOC);
            $super_credit = $rowcredit['payment'];
            $sub_admin_name = $rowcredit['sub_admin_id'];
       }
       
       
        $querysellercredit = "SELECT * FROM `u952853138_Hunterits`.`super` WHERE `sn`= '$super_seller_id' LIMIT 1";
        $resultssellercredit = $conn->prepare($querysellercredit);
          
        $resultssellercredit->execute();
        $countsellercredit = $resultssellercredit->rowCount();
        $rowsellercredit = $resultssellercredit->fetch(PDO::FETCH_ASSOC);
        $seller_credit = $rowsellercredit['payment'];
        If($seller_credit < 0 || $seller_credit < $add_credit){
             $_SESSION['credit_empty'] = "<h4 style='color:red;'> You Have No Enough Credit....</h4>";
             header('location:sub_admin_add.php');
        }
        else{
            $seller_credit =  ($seller_credit - $add_credit);
            $sqlseller = "UPDATE `u952853138_Hunterits`.`super` SET `payment`='$seller_credit' WHERE `sn`='$super_seller_id'";
            $sellerresult =  $conn->query($sqlseller);
            $sellerresult->execute();
            
            $super_credit = ($super_credit + $add_credit);
            $sqlsuper = "UPDATE `u952853138_Hunterits`.`sub_admin` SET `payment`='$super_credit' WHERE `san`='$admin_name'";
            $creditresult =  $conn->query($sqlsuper);
            $creditresult->execute();
            
            $todaydate = date('Y-m-d h:i:sa');
            $sqllog = "insert into `u952853138_Hunterits`.`credit_log` (`transaction_id`,`transaction_timestamp`,`transaction_by`, `transaction_for`, `credit_amount`, `mode`,`sub_admin_id`,`super_id`) VALUES ('','$todaydate','$sub_admin_name','$super_name','$add_credit','ADD','$admin_name','0')";
            $sellerresultlog =  $conn->query($sqllog);
           
            header("Location:sub_admin_home.php");
            $_SESSION['super_credit'] = $super_credit;
            $_SESSION['success'] = "<h4 style='color:green;'> Credit Deduct Successfully!</h4>";
        }
        
    }
    
} catch (PDOException $e) {
    echo "Credit Delete Failed" . $e->getMessage();
}
?>















<?php 
// include('config.php'); 
// include('sub_admin_validate_login.php');
// date_default_timezone_set("Asia/Calcutta");


// if(empty($_SESSION['subid']))
// {
?>
  <script>

          window.location = 'counterlogin.php?err=Session has been expired';
          </script>
<?php
//     exit;
// }
?>
<?php

// include('config.php'); 

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// } 

// $sn=$_GET["sn"];
// $panelid=$_GET["uid"];
// $num=$_GET["num"];
// $credit=0;
//  $reg_date=time();
 
//  $sql17 = "SELECT * FROM super where sn='$sn' AND s_id='$panelid'";
//  $result17= $con->query($sql17);
//  while($row = $result17->fetch_assoc()) {
//     $credit= $row["payment"];

//  }
//  $newcredit = $credit-$num;
 
//  $sql = "update super set payment = '$newcredit' where sn='$sn' AND s_id='$panelid'";

// if(isset($_SESSION['subid'])){
//     $adminid = $_SESSION['subid'];
    
//     $sqladminame = "SELECT * FROM sub_admin where san ='$adminid'";
//   $resultadminaem= $con->query($sqladminame);
//   while($rowadmin = $resultadminaem->fetch_assoc()) {
//     $adminname= $rowadmin["sub_admin_id"];

//   } 
// }
 
//  $sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode,admin_id) VALUES ('$adminname','$panelid','$num','DEDUCT','$adminid')";
 
// if ($con->query($sql) === TRUE AND $con->query($sql12) === TRUE) {
//   header('location:sub_admin_home.php?id=success');
//   exit;
// } else {
//  header('location:sub_admin_home.php?id=error');
//   exit;
// }

?>