
<?php 
include('database/config.php'); 
include('super_login_validate.php'); 

try {
   if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $add_credit = $_POST['num'];
        $super_seller_id = $_POST['sn'];
         $super_name = $_POST['uid'];
        if (isset($_SESSION['superid'])){
            $admin_name = $_SESSION['superid'];
            $todaydate =date('Y-m-d h:i:sa');
            $querycredit = "SELECT * FROM `u952853138_Hunterits`.`super` where `sn` = '$admin_name'";
            $resultscredit = $conn->prepare($querycredit);
            $resultscredit->execute();
            $countcredit = $resultscredit->rowCount();
            $rowcredit = $resultscredit->fetch(PDO::FETCH_ASSOC);
            $super_credit = $rowcredit['payment'];
            $sub_admin_name = $rowcredit['s_id'];
       }
       
        $querysellercredit = "SELECT * FROM `u952853138_Hunterits`.`userinfo` WHERE `sn`= '$super_seller_id' AND `super_id` = '$admin_name' LIMIT 1";
        $resultssellercredit = $conn->prepare($querysellercredit);
          
        $resultssellercredit->execute();
        $countsellercredit = $resultssellercredit->rowCount();
        $rowsellercredit = $resultssellercredit->fetch(PDO::FETCH_ASSOC);
        $seller_credit = $rowsellercredit['user_credit'];
    
    if ($seller_credit >= $add_credit) {
        $seller_credit = ($seller_credit -  $add_credit);
        $sqlseller = "UPDATE `u952853138_Hunterits`.`userinfo` SET `user_credit`='$seller_credit' WHERE `sn`='$super_seller_id'";
        $creditresult =  $conn->query($sqlseller);
        $creditresult->execute();
       
        $supernew_credit =  ($super_credit + $add_credit);

        $sqlsupernew = "UPDATE `u952853138_Hunterits`.`super` SET `payment`='$supernew_credit' WHERE `sn`='$admin_name'";
       
        $superrresultnew =  $conn->query($sqlsupernew);
        $superrresultnew->execute();
        if($conn->query($sqlsupernew)==true){
        $sqllog = "insert into `u952853138_Hunterits`.`credit_log` (`transaction_id`,`transaction_timestamp`,`transaction_by`, `transaction_for`, `credit_amount`, `mode`,`sub_admin_id`,`super_id`) VALUES ('','$todaydate','$sub_admin_name','$super_name','$add_credit','DEDUCT','0','$admin_name')";
        $sellerresultlog =  $conn->query($sqllog);
        }
        header("Location:super_seller_list.php");
        $_SESSION['super_credit'] = $supernew_credit;
        $_SESSION['success'] = 'Credit Deduct Successfully';
    } else {
        $_SESSION['credit_empty'] = "<h4 style='color:red;'> You Have No Enough Credit....</h4>";
        header('location:super_pay_deduct.php');
    }
        
    }
    
} catch (PDOException $e) {
    echo "Registration Failed" . $e->getMessage();
}
?>