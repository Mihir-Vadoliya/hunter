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
    
    if ($super_credit ==  $add_credit || $super_credit >  $add_credit) {
        $super_credit = ($super_credit -  $add_credit);
        $sqlsuper = "UPDATE `u952853138_Hunterits`.`sub_admin` SET `payment`='$super_credit' WHERE `san`='$admin_name'";
        $creditresult =  $conn->query($sqlsuper);
        $creditresult->execute();

       
        $querysellercredit = "SELECT * FROM `u952853138_Hunterits`.`super` WHERE `sn`= '$super_seller_id' LIMIT 1";
        $resultssellercredit = $conn->prepare($querysellercredit);
          
        $resultssellercredit->execute();
        $countsellercredit = $resultssellercredit->rowCount();
        $rowsellercredit = $resultssellercredit->fetch(PDO::FETCH_ASSOC);
        $seller_credit = $rowsellercredit['payment'];
        $seller_credit =  ($seller_credit + $add_credit);


        $sqlseller = "UPDATE `u952853138_Hunterits`.`super` SET `payment`='$seller_credit' WHERE `sn`='$super_seller_id'";
        $sellerresult =  $conn->query($sqlseller);
        $sellerresult->execute();
        $todaydate = date('Y-m-d h:i:sa');
        $sqllog = "insert into `u952853138_Hunterits`.`credit_log` (`transaction_id`,`transaction_timestamp`,`transaction_by`, `transaction_for`, `credit_amount`, `mode`,`sub_admin_id`,`super_id`) VALUES ('','$todaydate','$sub_admin_name','$super_name','$add_credit','ADD','$admin_name','0')";
        $sellerresultlog =  $conn->query($sqllog);
       
        header("Location:sub_admin_home.php");
        $_SESSION['super_credit'] = $super_credit;
        $_SESSION['success'] = "<h4 style='color:green;'> Credit Added Successfully!</h4>";
    } else {
        $_SESSION['credit_empty'] = "<h4 style='color:red;'> You Have No Enough Credit....</h4>";
        header('location:sub_admin_add.php');
    }
        
    }
    
} catch (PDOException $e) {
    echo "Registration Failed" . $e->getMessage();
}
?>