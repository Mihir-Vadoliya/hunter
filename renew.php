<?php 
   include('config.php'); 
   include('seller_login_validate.php');
   date_default_timezone_set("Asia/Kolkata");
       if(isset($_SESSION['sellerid'])){
           $panid = $_SESSION['sellerid'];
       }
    $sn=$_GET["sn"];
    $id=$_GET["id"];
   	$status=0;
   	$reg_date=time();
   	$payment=0;
   	$reg_date= date("Y-m-d h:i:sa",time());
   	$expiry_date=date('Y-m-d h:i:sa', strtotime('+31 days'));
   	$payment=0;
   	$admin_pay=0;
   	$super_pay=0;
   
   
   	$sn =  $con->real_escape_string($sn);
   	$id =  $con->real_escape_string($id);
   
   	$sql17 = "SELECT * FROM userinfo where sn=$panid";
   	$result17= $con->query($sql17);
   	while($rows = $result17->fetch_assoc()) {
   	   $credit= $rows["user_credit"];
   	   $userid = $rows['p_id'];
   	}
      
          $sql = "UPDATE details SET payment=1,registration='$reg_date',CreatedDate ='$reg_date',expiry_date='$expiry_date',admin_pay=0, super_pay=0, activated=0 WHERE  sn=$sn AND user_id='$id' ";
           
          if ($con->query($sql) === TRUE) {
          $sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode) VALUES ('$userid','".$id."','".$num."','DEDUCT')";
          if ($con->query($sql12) === TRUE) {
               header('location:keys.php?id=success');
               $_SESSION['creditempty'] = "<h4 style='color:green';>ID Extended Successfully...........!</h4>";
                exit;
          }
         
          } else {
          header('location:keys.php?id=fail');
          exit;
          }
   
   ?>
