<?php
include('admin_head.php');
include('config.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['adminid'])) {
   $adminnameod = $_SESSION['adminid'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM sub_admin where admin_id = '$adminnameod'";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);

   $queryresadmin = "SELECT * FROM mini_admin where admin_id = '$adminnameod'";
   $resultadmin = $con->query($queryresadmin);
   $totalbadminid = mysqli_num_rows($resultadmin);

   $queryresadmindeactive = "SELECT * FROM mini_admin where admin_id = '$adminnameod' && activated =1";
   $resultadmindeactive = $con->query($queryresadmindeactive);
   $totalbadminidactivated = mysqli_num_rows($resultadmindeactive);
}

$queryresdeactivate = "SELECT * FROM sub_admin where activated=1 AND expiry_date > CURDATE()";
$resultdeactivate = $con->query($queryresdeactivate);
$totalsubadmindeactivate = mysqli_num_rows($resultdeactivate);

$queryressellerlist = "SELECT * FROM userinfo";
$resultsellerlist = $con->query($queryressellerlist);
$totalsubadminsellerlist = mysqli_num_rows($resultsellerlist);

$queryressellerlistdeactivate = "SELECT * FROM userinfo where status=1";
$resultsellerlistdeactivate = $con->query($queryressellerlistdeactivate);
$totalsubadminsellerlistdeactivate = mysqli_num_rows($resultsellerlistdeactivate);

$queryressuperlist = "SELECT * FROM super";
$resultsuperlist = $con->query($queryressuperlist);
$totalsubadminsuperlist = mysqli_num_rows($resultsuperlist);

$queryressuperlistdeactivate = "SELECT * FROM super where status=1";
$resultsuperlistdeactivate = $con->query($queryressuperlistdeactivate);
$totalsubadminsuperlistdeactivate = mysqli_num_rows($resultsuperlistdeactivate);

if (isset($_SESSION['emptynamemsg']) || isset($_SESSION['emptyidmsg']) || isset($_SESSION['emptypassmsg']) || isset($_SESSION['emptyidmsg']) || isset($_SESSION['success'])) {
   $namemsg = $_SESSION['emptynamemsg'];
   $idmsg = $_SESSION['emptyidmsg'];
   $passmsg = $_SESSION['emptypassmsg'];
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);
   unset($_SESSION['emptyidmsg']);
   unset($_SESSION['emptypassmsg']);
   unset($_SESSION['emptynamemsg']);
}

if (isset($_SESSION['adminid'])) {
   $admin_names =  $_SESSION['adminid'];
   $todaydates = date('Y-m-d h:i:sa');
   $queryresss = "SELECT * FROM admin where an = '$admin_names'";
   $resultadminss = $con->query($queryresss);
   $rowadminaa = $resultadminss->fetch_assoc();
   $subadminname = $rowadminaa['username'];
}

$reg_date = time();
$reg_date1 = time() - (24 * 3600);
$todaydate = strtotime(date("Y-m-d", (time())));
$todaydatend = $todaydate + (24 * 3600);
$name = $_SESSION['info']['username'];

$sql11 = "SELECT * FROM details where activated=0 AND expiry_date > CURDATE() ";
$result11 = $con->query($sql11);
$rowcount11 = mysqli_num_rows($result11);

$sqlpaid = "SELECT * FROM details where admin_pay=1";
$resultpaid = $con->query($sqlpaid);
$rowcountpaid = mysqli_num_rows($resultpaid);

$sqlunpaid = "SELECT * FROM details where admin_pay=0";
$resultunpaid = $con->query($sqlunpaid);
$rowcountunpaid = mysqli_num_rows($resultunpaid);

$sql12 = "SELECT * FROM details where activated=1 AND expiry_date > CURDATE() ";
$result12 = $con->query($sql12);
$rowcount12 = mysqli_num_rows($result12);

$sql13 = "SELECT * FROM details WHERE registration >= CURDATE() AND registration < CURDATE() + INTERVAL 1 DAY ORDER BY registration";

$result13 = $con->query($sql13);
$rowcount13 = mysqli_num_rows($result13);

$sql16 = "SELECT * FROM details where expiry_date > CURDATE()";
$result16 = $con->query($sql16);
$rowcount16 = mysqli_num_rows($result16);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Men Admin Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="mini_admin_home.php">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
               </ol>
            </div><!-- /.col -->
         </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Info boxes -->
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL MASTER ADMIN</span>
                     <p><b><?php echo $totalbadminid ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL DEACTIVATE Master Admin</span>
                     <p><b><?php echo $totalbadminidactivated ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL ADMIN ID</span>
                     <p><b><?php echo $totalsubadmin ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">DEACTIVE ADMIN ID</span>
                     <p><b><?php echo $totalsubadmindeactivate ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
         </div>
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL SUPER ID</span>
                    <p><b><?php echo $totalsubadminsuperlist ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">DEACTIVE SUPER ID</span>
                     <p><b><?php echo $totalsubadminsuperlistdeactivate ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL SELLER ID</span>
                     <p><b><?php echo $totalsubadminsellerlist ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">DEACTIVE SELLER ID</span>
                     <p><b><?php echo $totalsubadminsellerlistdeactivate ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
         </div>
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">Total ID</span>
                     <p><b><?php echo $rowcount16 ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">Active ID</span>
                     <p><b><?php echo $rowcount11 ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">Deactive ID</span>
                     <p><b><?php echo $rowcount12 ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">Total Paid ID</span>
                     <p><b><?php echo $rowcountpaid ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
         </div>
         <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL UNPAID ID</span>
                     <p><b><?php echo $rowcountunpaid ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TODAY CREATE ID</span>
                     <p><b><?php echo $rowcountunpaid ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user-check"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TOTAL EXPIRED ID</span>
                    <p><b><?php echo $rowcountunpaid ?></b></p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
               <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                     <span class="info-box-text">TODAY RESULT</span>
                     <p><b>
                  <?php

                    $todaydate =  date('Y-m-d');
                    $querytores = "SELECT * FROM `u952853138_Hunterits`.`tickets3`";
                    $resulttores = mysqli_query($con, $querytores);
                    $counttores = mysqli_num_rows($resulttores);

                    if ($counttores > 0) {
                        $i = 0;
                        while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                            $regdate =  $rowpantores['tDate'];
                            $registrationdate = date("Y-m-d", strtotime($regdate));
                            if ($todaydate == $registrationdate) {
                                $i++;
                            }
                        }
                        echo $i;
                    }


                    ?>
                  </b>
               </p>
                  </div>
                  <!-- /.info-box-content -->
               </div>
               <!-- /.info-box -->
            </div>
            <!-- /.col -->
         </div>
         
         <!-- /.row -->
      </div><!--/. container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<?php
include('footer.php');
?>