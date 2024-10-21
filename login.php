<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login-Hunter</title>
    <style>
        .material-half-bg .cover{
                background:url('img/rbt');
                height: 110%;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                }
    </style>
  </head>
<?php 
   session_start();
   if (isset($_SESSION['subid'])) {
       header('location:sub_admin_home.php');
   }
   else if (isset($_SESSION['adminid'])) {
       header('location:admin_home.php');
   }
   else if(isset($_SESSION['superid'])){
       header('location:super_home.php');
   }
   else if(isset($_SESSION['sellerid'])){
        header('location: home.php');
   }
   
   
   include('config.php');
     $pwdErr = $emailErr = $Err = "";
   
   
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       //session_start();
       // if ($_POST['captcha'] != $_SESSION['digit']) {
   
       //   die("Sorry, the CAPTCHA code entered was incorrect!");
       //   session_destroy();
       // }
   
       $pwdErr = $emailErr = $Err = "";
       $email = $pwd = "";
       $flag = 0;
       $message = "";
       $email = $_POST["id"];
       $pwd = $_POST["pass"];
       $usertype = $_POST["UserType"];
   
       $pwd = "jgc" . md5($pwd);
   
   
       if ($usertype == '0') {
         
         $email1 =  $con->real_escape_string($email);
         $pwd1 =  $con->real_escape_string($pwd);
   
         $src = $con->query("SELECT * FROM `userinfo`  WHERE `p_id`='$email1' AND `password`='$pwd1'") or die(mysqli_error());    
         
         $flag = 0;
   
         if ($src->num_rows > 0  && ($flag == 0)) {
           
           $Err = "";
           $rows = $src->fetch_assoc();
           $_SESSION['info'] = $rows; 
           $_SESSION['sellerid'] = $rows['sn'];
           $_SESSION['pan_id'] = $rows['p_id'];
           $active = $rows['status'];
           
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
   
           if (isset($_SESSION['sellerid']) && $active == 0) {
   
            ?>
<script>
   window.location = 'home.php?id=';
</script>
<?php
   header('Location:home.php?id=');
   exit;
   }
   else{
        $Err = "APKA PAYMENT DUE HAI, APNE SUPER SE BOLKAR ADMIN PYMNT CLEAR KARWAYE, DUE CLEAR HONE BAAD PANEL CHALU KAR DIYA JAYEGA!";
        unset($_SESSION['sellerid']);
   }
   } else {
   $Err = "UNREGISTERED ID OR INCORRECT PASSWORD TYPED!";
   unset($_SESSION['info']['sellerid']);
   }
   } elseif ($usertype == '1') {
   
   //include('config.php'); 
   $email1 =  $con->real_escape_string($email);
   $pwd1 =  $con->real_escape_string($pwd);
   
   $src = $con->query("SELECT * FROM super  WHERE `s_id`='$email1' AND `password`='$pwd1'") or die(mysqli_error());
   
   
   
   if ($src->num_rows > 0) {
   
   //include('config.php');
   $Err = "";
   $rowss = $src->fetch_assoc();
   $_SESSION['info'] = $rowss;
   $_SESSION['start'] = time();
   $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
   $_SESSION['superid'] = $rowss['sn'];
   $_SESSION['supername'] = $rowss['s_id'];
   $actives = $rowss['status'];
   
   
   
   if (isset($_SESSION['superid']) && $actives == 0) {
   ?><script>
   window.location = 'super_home.php?id=';
</script>
<?php
   header('Location:super_home.php?id=');
   exit;
   }
   else{
        $Err = "*AAP KA ADMIN PEYMENT DEU HAI ADMIN DEU CLEAR HONE BAAD PANEL CHALU KAR DIYA JAYEGA!*";
        unset($_SESSION['superid']);
   }
   } else {
   $Err = "UNREGISTERED ID OR INCORRECT PASSWORD TYPED!";
   unset($_SESSION['info']['superid']);
   }
   } elseif ($usertype == '2') {
   $email1 =  $con->real_escape_string($email);
   $pwd1 =  $con->real_escape_string($pwd);
   
   $src = $con->query("SELECT * FROM admin  WHERE `admin_id`='$email1' AND `password`='$pwd1'") or die(mysqli_error());
   
   
   if ($src->num_rows > 0) {
   
   //include('config1.php'); 
   $Err = "";
   $rowa = $src->fetch_assoc();
   $_SESSION['info'] = $rowa;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
    $_SESSION['adminid'] = $rowa['an'];
    $_SESSION['adminname'] = $rowa['admin_id'];
   
   
   
   if (isset($_SESSION['adminid'])) {
        header('Location:admin_home.php');
   }
   } else {
   $Err = "UNREGISTERED ID OR INCORRECT PASSWORD TYPED!";
   header('Location:index.php');
    unset($_SESSION['info']['adminid']);
   }
   } elseif ($usertype == '4') {
   $email1 =  $con->real_escape_string($email);
   $pwd1 =  $con->real_escape_string($pwd);
   
   $srcminiadmin = $con->query("SELECT * FROM mini_admin  WHERE `mini_admin_id`='$email1' AND `password`='$pwd1'") or die(mysqli_error());
   
   
   if ($srcminiadmin->num_rows > 0) {
   
   //include('config1.php'); 
   $Err = "";
   $rowmini = $srcminiadmin->fetch_assoc();
   $_SESSION['info'] = $rowmini;
   $_SESSION['start'] = time();
   $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
   $_SESSION['miniadmin_id'] = $rowmini['mini_id'];
   $_SESSION['miniadmin_username'] = $rowmini['mini_admin_id'];
   $activated = $rowmini['activated']; 
   
   
   
   if (isset($_SESSION['miniadmin_id']) && $activated == 0) {
        header('Location:mini_admin_home.php');
   }
   else{
        $Err = "*AAP KA ADMIN PEYMENT DEU HAI ADMIN DEU CLEAR HONE BAAD PANEL CHALU KAR DIYA JAYEGA!*";
        unset($_SESSION['miniadmin_id']);
   }
   } else {
    $Err = "UNREGISTERED ID OR INCORRECT PASSWORD TYPED!";
    header('Location:index.php');
    unset($_SESSION['info']['miniadmin_id']);
   }
   } elseif ($usertype == '3') {
   $email1 =  $con->real_escape_string($email);
   $pwd1 =  $con->real_escape_string($pwd);
   
   $src = $con->query("SELECT * FROM sub_admin  WHERE `sub_admin_id`='$email1' AND `password`='$pwd1'") or die(mysqli_error());
   
   
   if ($src->num_rows > 0) {
   
   //include('config1.php'); 
   $Err = "";
   $rowsa = $src->fetch_assoc();
   $_SESSION['info'] = $rowsa;
   $_SESSION['start'] = time();
   $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
   $_SESSION['subid'] = $rowsa['san'];
   $_SESSION['subadminname'] = $rowsa['sub_admin_id'];
   $activesa = $rowsa['activated'];
   
   
   
   if (isset($_SESSION['subid']) && $activesa == 0) {
   ?><script>
   window.location = 'subadmin_dashboard.php?id=';
</script>
<?php
   }
   else{
        $Err = "*AAP KA ADMIN PEYMENT DEU HAI ADMIN DEU CLEAR HONE BAAD PANEL CHALU KAR DIYA JAYEGA!*";
        unset($_SESSION['subid']);
   }
   } else {
   $Err = "UNREGISTERED ID OR INCORRECT PASSWORD TYPED!";
    unset($_SESSION['info']['subid']);
   }
   } 
   
   else {
   $message = "INCORRECT USERID OR PASSWORD";
   unset($_SESSION['info']);
   } }
   
   function test_input($data)
   {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
   }
   
   ?>
   <body>
    
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Hunter</h1>
      </div>
      <div class="login-box">
        <form method="post" id="loginform" class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
           <div class="form-group">
            <label class="control-label"><?php echo $Err ; ?></label>
          </div>
          <div class="form-group">
             <select class="form-control"  name="UserType" id="UserType" class="usertype">
                <option selected="selected" value="0">Seller</option>
                <option  value="1">Super</option>
                <option  value="2">Master Admin</option>
                <option  value="3">Mini</option>
                 <option  value="4">Admin</option>
              </select>
          </div>
          <div class="form-group">
          
            <input class="form-control" type="text" name="id" placeholder="username" class="username" value="">
          </div>
          <div class="form-group">
            
            <input class="form-control" type="password" name="pass" placeholder="password" class="password">
          </div>
        
          <div class="form-group btn-container">
           
            <input class="btn btn-primary btn-block" type="submit" name="save" value="Login" class="submit">
          </div>
              <!--SETPLink-->
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="https://mega.nz/file/pjcG3ILD#0kSm4QGlFsVkZzraR3qFtXtNm2slwx7x8KGG9yJa_Q4" > Download Zip Files </a></p>
            <p class="semibold-text mb-0"><a href="https://mega.nz/file/pjcG3ILD#0kSm4QGlFsVkZzraR3qFtXtNm2slwx7x8KGG9yJa_Q4" > Download Exe Files </a></p>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
          <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>


