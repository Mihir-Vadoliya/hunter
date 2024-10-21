<?php
include('seller_head.php');

$sql = "SELECT news FROM `soft_news` where nno=2";
$i = 0;
//$sql = "SELECT * FROM details";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $i = $i + 1;
        $msg = $row["news"];
    }
}


if (isset($_SESSION['sellerid'])) {
    $supername =  $_SESSION['sellerid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM userinfo where sn = '$supername'";
    $result = $con->query($queryres);
    $rowssubadmin = $result->fetch_assoc();
    $supernamess = $rowssubadmin['name'];
}

$me = $_SESSION['info']['p_id'];
$reg_date = date('Y-m-d h:i:sa');
//$sql = "SELECT * FROM details where agent_user='$me'";
$sql11 = "SELECT * FROM details where activated=0 AND expiry_date > CURDATE() AND agent_user='$me'";
$result11 = $con->query($sql11);
$rowcount11 = mysqli_num_rows($result11);
//echo $rowcount11;
$sql12 = "SELECT * FROM details where activated=1 AND expiry_date > CURDATE() AND agent_user='$me'";
$result12 = $con->query($sql12);
$rowcount12 = mysqli_num_rows($result12);

$sql16 = "SELECT * FROM details where expiry_date > CURDATE() AND agent_user='$me'";
$result16 = $con->query($sql16);
$rowcount16 = mysqli_num_rows($result16);


$credit = 0;
$sql17 = "SELECT * FROM userinfo where p_id='" . $_SESSION['info']['p_id'] . "'";
$result17 = $con->query($sql17);
while ($row = $result17->fetch_assoc()) {
    $credit = $row["user_credit"];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Seller Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
            <h3>
                Hi, <strong class="text-success"><?php echo $supernamess ?> </strong>..Panel Me Jo Vi Unpaid id Create Hoga Use Master,Admin And Super Panel Me Credit Dal Kar key Ko Paid Karna Hoga..Jo Vi Key Paid Hoga Uska Peyment Apne Super Ko Par Day Clear Karna Hoga.. Nahi To 24 Hours Ke Under All Key and Panel Deactiv kar Diya Jayega..Paid key Delete Nahi hoga Only Unpiad key Delete Kiye Jayega..Seller Panel Me Residential Proxy Jis Key Ko Slot Me IP Add Kroge to Us Slot Me Unlimited Pair Only Hunter Software Aws Vps Pe Drect Login Hoga...Residential Proxy Panel Ka ID And Pass Ke Liye Apne Admin Se Conect Karo!
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
                            <h4>Credits</h4>
                            <p><b><?php echo $credit ?></b></p>
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
                        <h4>TODAYS SOLD ID</h4>
                            <p><b><?php
                                    include('database/config.php');
                                    $todaydate =  date('Y-m-d');
                                    $querytores = "SELECT * FROM details where agent_user in (Select p_id from userinfo where sn  = '$supername')";
                                    $resulttores = mysqli_query($con, $querytores);
                                    $counttores = mysqli_num_rows($resulttores);

                                    if ($counttores > 0) {
                                        $i = 0;
                                        while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                                            $regdate =  $rowpantores['registration'];
                                            $registrationdate = date("Y-m-d", strtotime($regdate));
                                            if ($todaydate == $registrationdate) {
                                                $i++;
                                            }
                                        }
                                        echo $i;
                                    }


                                    ?></b></p>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
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