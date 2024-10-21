<?php 
include('database/config.php'); 
date_default_timezone_set("Asia/Calcutta");
include('super_login_validate.php');

if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id=trim(strtoupper($_POST["userid"]));
        $uname=trim(strtoupper($_POST["username"]));
        $status=0;
        $password= md5($_POST['pass']);
        $pass="jgc".$password;
        $status=0;
        $payment=0;
        $registration = date('Y-m-d h:i:sa');
        $expdatea   = date('Y-m-d h:i:sa', strtotime('+30 days'));
        $expdate   = date('Y-m-d h:i:sa', strtotime($expdatea));
        if(empty($uname) || empty($id) || empty($password)){
            $_SESSION['emptynamemsg'] = "Please Enter Super Name";
            $_SESSION['emptyidmsg'] = "Please Enter Super Id";
            $_SESSION['emptypassmsg'] = "Please Enter Super Password";
            header('location:super_seller_list.php');
        }
        else{
            
            if(isset($_SESSION['superid'])){
                $sub_admin_id = $_SESSION['superid'];
                $querysubadmin = "SELECT * FROM `u952853138_Hunterits`.`super` WHERE `sn`= '$sub_admin_id' LIMIT 1";
                $resultssubadmin = $conn->prepare($querysubadmin);
                $resultssubadmin->execute();
                $rowsubadmin = $resultssubadmin->fetch(PDO::FETCH_ASSOC);
                $subadminname = $rowsubadmin['s_id'];
                $stmntsub = "insert into `u952853138_Hunterits`.`userinfo` (`sn`,`super_name`, `name`, `p_id`, `password`, `status`,`user_credit`,`super_id`,`registration`,`expire-date`) values('','$subadminname','$uname','$id','$pass','$status','$payment','$sub_admin_id','$registration','$expdate')";
                $resultsub = $conn->query($stmntsub);
                 if (!empty($resultsub)) {
                        $_SESSION['success'] = "<p class='ms-5' style='color:green;'> Data Inserted Successfully..</p>";               
                        header("Location:super_seller_list.php?id=SUCCESSFULLY_REGISTERED");
                } else {
                     $_SESSION['success'] = "<p style='color:red;'> Data Inserted Failed..</p>";
                    header("Location:super_seller_list.php?id=error");
                }  
            }
        }
    }

?>
