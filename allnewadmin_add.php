<?php 
   include('config.php'); 
   date_default_timezone_set("Asia/Calcutta");
   include('admin_login_validate.php');

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
     //include('config1.php'); 
     $reg = date('Y-m-d h:i:sa');
     $expiry_dates=date('Y-m-d h:i:sa', strtotime('+30 days'));
   	 $expiry_date=date('Y-m-d h:i:sa', strtotime($expiry_dates));
     $id=strtoupper($_POST["userid"]);
     $uname=strtoupper($_POST["username"]);
     $status=0;
     $pass=$_POST["pass"];
     $pass="jgc".md5($pass);
     
       $status=0;
       $payment=0;
       $activated = 0;
      if(isset($_SESSION['adminid'])){
           $admin_name = $_SESSION['adminid'];
      }
   
    if (!empty($uname) && !empty($admin_name)) {
     $uname =  $con->real_escape_string($uname);
     $pass =  $con->real_escape_string($pass);
    //  $admin_name = uniqid();
   $sql = "insert into mini_admin (mini_username, mini_admin_id	, password,registration,expiry_date,activated,status,payment,admin_id) 
   values('" . $uname . "','".$id ."','". $pass . "','" .$reg . "','" .$expiry_date. "','" . $activated. "','".$status."','".$payment . "','" .  $admin_name. "')";
   
   } else {
       echo "LOGIN AGAIN";
   }
   
   
   if ($con->query($sql) === TRUE) {
    $_SESSION['success'] = 'Master Admin Create Successfully';
      header('location:alladmin_create.php?id=SUCCESSFULLY_ADDED_MINI_ADMIN');
           exit;
   } else {
       header('location:alladmin_create.php?id=OOPS_TRY_AGAIN_LATER');
           exit;
   }
   
     }

     