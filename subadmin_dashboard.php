<?php
include('sub_admin_head.php');
date_default_timezone_set("Asia/Calcutta");
$sql = "SELECT news FROM `soft_news` where nno=5";
$i = 0;
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        $msg = $row["news"];
    }
}

if (isset($_SESSION['subid'])) {
    $subadmin_name =  $_SESSION['subid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM super where sub_admin_id = '$subadmin_name'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $subadminname = $rowssubadmin['username'];
    $totalsubadmin = mysqli_num_rows($result);
}

$queryactive = "SELECT * FROM super where status = 0 and sub_admin_id = '$subadmin_name'";
$resultactive = $con->query($queryactive);
$totalactivesubadmin = mysqli_num_rows($resultactive);

$querydeactive = "SELECT * FROM super where status = 1 and sub_admin_id = '$subadmin_name'";
$resultdeactive = $con->query($querydeactive);
$totaldeactivesubadmin = mysqli_num_rows($resultdeactive);

$credit19 = 0;
$sql19 = "SELECT * FROM sub_admin where san  = '$subadmin_name'";
$result19 = $con->query($sql19);
while ($row = $result19->fetch_assoc()) {
    $credit19 = $row["payment"];
}

$sqlallsubadmin = "SELECT * FROM sub_admin WHERE registration >= CURDATE() AND registration < CURDATE() + INTERVAL 1 DAY ORDER BY registration";

$resultallsubadmin = $con->query($sqlallsubadmin);
$rowcountallsubadmin = mysqli_num_rows($resultallsubadmin);

$queryresseller = "SELECT * FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id ='$subadmin_name')";
$resultseller = $con->query($queryresseller);
$totalsubadminseller = mysqli_num_rows($resultseller);

$queryactiveseller = "SELECT * FROM userinfo where status = 0 and super_id in (SELECT sn FROM super where sub_admin_id ='$subadmin_name')";
$resultactiveseller = $con->query($queryactiveseller);
$totalactivesubadminseller = mysqli_num_rows($resultactiveseller);

$querydeactiveseller = "SELECT * FROM userinfo where status = 1 and super_id in (SELECT sn FROM super where sub_admin_id ='$subadmin_name')";
$resultdeactiveseller = $con->query($querydeactiveseller);
$totaldeactivesubadminseller = mysqli_num_rows($resultdeactiveseller);

$queryresallid = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$subadmin_name')) ";
$resultallid = $con->query($queryresallid);
$totalsubadminallid = mysqli_num_rows($resultallid);

$sqlallsubadminallid = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$subadmin_name')) and registration >= CURDATE() AND registration < CURDATE() + INTERVAL 1 DAY ORDER BY registration";

$resultallsubadminallid = $con->query($sqlallsubadminallid);
$rowcountallsubadminallid = mysqli_num_rows($resultallsubadminallid);


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="subadmin_dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr> 
            <h3>
                News:- <strong class="text-success"><?php echo $subadminname ?> </strong>..Unpiad key Ko Piad Karne Ke Liye Apne Master Admin Se Panel Me Credit Lena Hoga..Admin, And Super Se Key ko Paid Kar Sakte hai..Jo Vi Key Paid Hoga Uska Peyment Apne Mater Admin Ko Clear Karna Hoga.. Nahi To 48 Hours Ke Under All Key and Panel Deactiv kar Diya Jayega..Paid key Delete Nahi Hoga Only Unpiad key Delete Kiye Jayega..Seller Panel Me Residential Proxy Jis Key Ko Slot Me IP Add Kroge to Us Slot Me Unlimited Pair Only Hunter Software Aws Vps Me Drect Login Hoga...Residential Proxy Panel Ka ID And Pass Ke Liye Apne Admin Se Conect Karo!
            </h3> !.
            </h3>
            <hr>
            <h3>
               <strong class="text-success"><?php echo $msg ?></strong>
            </h3>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <h4>ALL ID</h4>
                            <p><b><?php echo $totalsubadminallid ?></b></p>
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
                            <h4>TODAY SOLD ID</h4>
                            <p><b><?php echo $rowcountallsubadminallid ?></b></p>
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
                            <h4>Total Super ID</h4>
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
                            <h4>Deactivate Seller ID</h4>
                            <p><b><?php echo $totaldeactivesubadminseller ?></b></p>
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