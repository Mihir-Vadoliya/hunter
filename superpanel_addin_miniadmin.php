<?php 
include('database/config.php'); 
date_default_timezone_set("Asia/Calcutta");
include('miniadmin_login_validate.php');

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
            header('location:miniadmin_superlist.php');
        }
        else{
            
            if(isset($_SESSION['miniadmin_id'])){
                $sub_admin_id = $_SESSION['miniadmin_id'];
                $querysubadmin = "SELECT * FROM `u952853138_Hunterits`.`mini_admin` WHERE `mini_id`= '$sub_admin_id' LIMIT 1";
                $resultssubadmin = $conn->prepare($querysubadmin);
                $resultssubadmin->execute();
                $rowsubadmin = $resultssubadmin->fetch(PDO::FETCH_ASSOC);
                $subadminname = $rowsubadmin['mini_admin_id'];
                $stmntsub = "insert into `u952853138_Hunterits`.`super` (`sn`,`admin_name`, `name`, `password`, `s_id`, `payment`,`status`,`admin_id`,`registration`,`expire_date`,`miniadmin_id`) values('','$subadminname','$uname','$pass','$id','$payment','0','0','$registration','$expdate','$sub_admin_id')";
                $resultsub = $conn->query($stmntsub);
                 if (!empty($resultsub)) {
                       // $_SESSION['success'] = "<p class='ms-5' style='color:green;'> Data Inserted Successfully..</p>";               
                        header("Location:miniadmin_superlist.php?id=SUCCESSFULLY ADDED SUPER ID!");
                } else {
                    // $_SESSION['success'] = "<p style='color:red;'> Data Inserted Failed..</p>";
                    header("Location:miniadmin_superlist.php?id= FAILED!");
                }  
            }
        }
    }