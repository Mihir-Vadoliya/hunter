<?php 
include('database/config.php'); 
date_default_timezone_set("Asia/Calcutta");
include('sub_admin_login_validate.php');

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
            header('location:sub_admin_home.php');
        }
        else{
            
            if(isset($_SESSION['subid'])){
                $sub_admin_id = $_SESSION['subid'];
                $querysubadmin = "SELECT * FROM `u952853138_Hunterits`.`sub_admin` WHERE `san`= '$sub_admin_id' LIMIT 1";
                $resultssubadmin = $conn->prepare($querysubadmin);
                $resultssubadmin->execute();
                $rowsubadmin = $resultssubadmin->fetch(PDO::FETCH_ASSOC);
                $subadminname = $rowsubadmin['sub_admin_id'];
                $stmntsub = "insert into `u952853138_Hunterits`.`super` (`sn`,`admin_name`, `name`, `password`, `s_id`, `payment`,`status`,`sub_admin_id`,`admin_id`,`registration`,`expire_date`) values('','$subadminname','$uname','$pass','$id','$payment','0','$sub_admin_id','0','$registration','$expdate')";
                $resultsub = $conn->query($stmntsub);
                 if (!empty($resultsub)) {
                        $_SESSION['success'] = "<p class='ms-5' style='color:green;'> Super Created Successfully..</p>";               
                        header("Location:sub_admin_home.php");
                } else {
                     $_SESSION['success'] = "<p style='color:red;'> Data Inserted Failed..</p>";
                    header("Location:sub_admin_home.php");
                }  
            }
        }
    }