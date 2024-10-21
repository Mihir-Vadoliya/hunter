<?php
include('mini_admin_head.php');
include('config.php');
$sql = "SELECT news FROM `soft_news` where nno=4";
$i = 0;
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        $msg = $row["news"];
    }
}

date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['miniadmin_id'])) {
    $adminnameod = $_SESSION['miniadmin_id'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM sub_admin where mini_admin_id = '$adminnameod'";
    $result = $con->query($queryres);
    $totalsubadmin = mysqli_num_rows($result);
}

$queryresdeactivate = "SELECT * FROM sub_admin where activated=1 AND expiry_date > CURDATE() AND mini_admin_id = '$adminnameod'";
$resultdeactivate = $con->query($queryresdeactivate);
$totalsubadmindeactivate = mysqli_num_rows($resultdeactivate);

$queryressellerlist = "SELECT * FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod'))";
$resultsellerlist = $con->query($queryressellerlist);
$totalsubadminsellerlist = mysqli_num_rows($resultsellerlist);

$queryressellerlistdeactivate = "SELECT * FROM userinfo where status=1 and super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod'))";
$resultsellerlistdeactivate = $con->query($queryressellerlistdeactivate);
$totalsubadminsellerlistdeactivate = mysqli_num_rows($resultsellerlistdeactivate);

$queryressuperlist = "SELECT * FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod')";
$resultsuperlist = $con->query($queryressuperlist);
$totalsubadminsuperlist = mysqli_num_rows($resultsuperlist);

$queryressuperlistdeactivate = "SELECT * FROM super where status=1 and sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod')";
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

$sql11 = "SELECT * FROM details where activated=0 AND agent_user in (SELECT p_id from userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod'))) ";
$result11 = $con->query($sql11);
$rowcount11 = mysqli_num_rows($result11);

$sql12 = "SELECT * FROM details where activated=1 AND agent_user in (SELECT p_id from userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod')))";
$result12 = $con->query($sql12);
$rowcount12 = mysqli_num_rows($result12);

$sql13 = "SELECT * FROM details WHERE agent_user in (SELECT p_id from userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod'))) and registration >= CURDATE() AND registration < CURDATE() + INTERVAL 1 DAY ORDER BY registration";

$result13 = $con->query($sql13);
$rowcount13 = mysqli_num_rows($result13);

$sql16 = "SELECT * FROM details where agent_user in (SELECT p_id from userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod')))";
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
                    <h1 class="m-0 text-dark">Master Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="mini_admin_home.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
            <h3>
                Hi, <strong class="text-success"><?php echo $subadminname ?> </strong>..Unpiad key Ko Piad Karne Ke Liye Apne Men Admin Se Panel Me Credit Lena Hoga..Master,Admin, And Super Se Key ko Paid Kar Sakte hai.Jo Vi Key Paid Hoga Uska Peyment Apne Men Admin Ko Har Sunday Tak Clear Karna Hoga..Nahi To Monday Ko All Key and Panel Deactiv kar Diya Jayega..Bina Payment Ka Kisi Ka Panel Active Nehi Kiya Jayega..Paid key Delete Nahi hoga Only Unpiad key Delete Kiye Jayega....Seller Panel Me Residential Proxy Jis Key Ko Slot Me IP Add Kroge to Us Slot Me Unlimited Pair Only Hunter Software Aws Vps Pe Drect Login Hoga...Residential Proxy Panel Ka ID And Pass Ke Liye Apne Admin Se Conect Karo!
            </h3>
            <hr>
            <h3>
                           <strong class="text-success"><?php echo $msg ?> </strong>
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
                            <h4>Total ID</h4>
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
                            <h4>Acitvate ID</h4>
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
                            <h4>Deactivate ID</h4>
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
                            <h4>Todays Sold ID</h4>
                            <p><b><?php echo $rowcount13 ?></b></p>
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
                            <h4>Total Admin ID</h4>
                            <p><b><?php echo $totalsubadmin ?></b></p>
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
                            <h4>Deactive Admin ID</h4>
                            <p><b><?php echo $totalsubadmindeactivate ?></b></p>
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
                            <p><b><?php echo $totalsubadminsuperlist ?></b></p>
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
                            <h4>Deactive Super ID</h4>
                            <p><b><?php echo $totalsubadminsuperlistdeactivate ?></b></p>
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
                            <h4>Total Seller ID</h4>
                            <p><b><?php echo $totalsubadminsellerlist ?></b></p>
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
                            <h4>Deactive Seller ID</h4>
                            <p><b><?php echo $totalsubadminsellerlistdeactivate ?></b></p>
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
                            <h4>Today Result</h4>
                            <p><b>
                                    <?php

                                    $todaydate =  date('Y-m-d');
                                    $querytoress = "SELECT * FROM tickets WHERE UserID in (SELECT user_id from details where agent_user in (SELECT p_id from userinfo where super_id in (SELECT sn FROM super where sub_admin_id in (SELECT san from sub_admin WHERE mini_admin_id ='$adminnameod'))))";
                                    $resulttoress = $con->query($querytoress);
                                    $counttoress = mysqli_num_rows($resulttoress);

                                    if ($counttoress > 0) {
                                        $i = 0;
                                        while ($rowpantoress = $resulttoress->fetch_assoc()) {

                                            $regdate =  $rowpantoress['PNR_Time'];
                                            $registrationdate = date("Y-m-d", strtotime($regdate));
                                            if ($todaydate == $registrationdate) {
                                                $i++;
                                            }
                                        }
                                        echo $i;
                                    }
                                    ?>
                                </b></p>
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
                            <h4>Deactive Super ID</h4>
                            <p><b><?php echo $totalsubadminsuperlistdeactivate ?></b></p>
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