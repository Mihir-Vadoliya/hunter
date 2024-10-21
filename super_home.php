<?php
include('super_head.php');
$sql = "SELECT news FROM `soft_news` where nno=3";
$i = 0;
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        $msg = $row["news"];
    }
}


if (isset($_SESSION['superid'])) {
    $admin_name = $_SESSION['superid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM userinfo where super_id = '$admin_name'";
    $result = $con->query($queryres);
    $totalsubadmin = mysqli_num_rows($result);
}


if (isset($_SESSION['superid'])) {
    $supername =  $_SESSION['superid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM super where 	sn = '$supername'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $supernamess = $rowssubadmin['name'];
}
?>

<?PHP
$queryactive = "SELECT * FROM userinfo where super_id = '$admin_name' and status = 0";
$resultactive = $con->query($queryactive);
$totalactivesubadmin = mysqli_num_rows($resultactive);

$querydeactive = "SELECT * FROM userinfo where super_id = '$admin_name' and status = 1";
$resultdeactive = $con->query($querydeactive);
$totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
// $creditrow = $resultdeactive->fetch_assoc();
// $totalcredit = $creditrow['payment'];

$credit19 = 0;
$sql19 = "SELECT * FROM super where sn  = '$admin_name'";
$result19 = $con->query($sql19);
while ($row = $result19->fetch_assoc()) {
    $credit19 = $row["payment"];
}
$sqltodaycreateid = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id  = '$admin_name') and registration >= CURDATE() AND registration < CURDATE() + INTERVAL 1 DAY ORDER BY registration";

$resulttodaycreateid = $con->query($sqltodaycreateid);
$rowcounttodaycreateid = mysqli_num_rows($resulttodaycreateid);

$queryressuperallid = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id  = '$admin_name') ";
$resultsuperallid = $con->query($queryressuperallid);
$totalsubadminsuperallid = mysqli_num_rows($resultsuperallid);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Super Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="super_home.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
            <h3>
                Hi, <strong class="text-success"><?php echo$supernamess ?> </strong>...Unpiad key Ko Piad Karne Ke Liye Apne Admin Se Panel Me Credit Lena Hoga..Jo Vi Key Paid Hoga Uska Peyment 36 Hours Ke Under Me Apne Admin Ko Peyment Clear Karna Hoga.. Nahi To All Key and Panel Deactiv kar Diya Jayega..Paid key Delete Nahi Hoga Only Unpiad key Delete Kiye Jayega..Seller Panel Me Residential Proxy Jis Key Ko Slot Me IP Add Kroge to Us Slot Me Unlimited Pair Only Hunter Software Aws Vps Pe Drect Login Hoga...Residential Proxy Panel Ka ID And Pass Ke Liye Apne Admin Se Conect Karo!
            </h3>
                <hr>
           <h3>
            <?php echo "$msg";?>
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
                            <h4>All ID</h4>
                            <p><b><?php echo $totalsubadminsuperallid ?></b></p>
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
                            <h4>Todays Sold ID</h4>
                            <p><b><?php echo $rowcounttodaycreateid ?></b></p>
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
                            <h4>Total Seller ID</h4>
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
                            <p><b><?php echo $totaldeactivesubadmin ?></b></p>
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
                            <h4>Deactivate Seller ID</h4>
                            <p><b><?php echo $totaldeactivesubadmin ?></b></p>
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