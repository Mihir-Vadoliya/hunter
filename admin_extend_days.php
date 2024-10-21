<?php
include('admin_head.php');
include('database/config.php');
date_default_timezone_set("Asia/Kolkata");

$warningmsg = '';

if (isset($_SESSION['success'])) {
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);
   unset($_SESSION['emptyidmsg']);
   unset($_SESSION['emptypassmsg']);
   unset($_SESSION['emptynamemsg']);
}
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Master Admin Dashboard</h1>
          <h5 class="m-0 text-success"><?php echo $warningmsg ?></h5>
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
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Extend Days </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="row my-2">
                <form action="admin_extend_days.php" method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="form-group">
                          <label for="clientid" class="form-label mt-4">Days</label>
                          <input type="number" class="form-control" name="enterdays" id="days" aria-describedby="days" required placeholder="Enter Days">
                          <input type="hidden" class="form-control" name="userid" id="clientid" value="<?php echo $userpanid; ?>" aria-describedby="clientid" required placeholder="CLIENT ID">
                        </div>
                      </div>
                      <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <div class="mt-4 py-2">
                          <input type="submit" class="btn btn-info form-control mt-4" name="extend_id" value="Extend ID" id="popUpYes">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
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

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $extenddate = $_POST['enterdays'];
    $todaydate = date('Y-m-d h:i:sa');
    $sql = "SELECT * FROM `u952853138_Hunterits`.`details`";
    $results = $conn->prepare($sql);
    $results->execute();
    $count = $results->rowCount();
    if ($count > 0) {
        $i =1;
        while( $row = $results->fetch(PDO::FETCH_ASSOC)){
            $expiredate = $row['expiry_date'];
            $timemodified1 = date('Y-m-d h:i:sa', strtotime($expiredate));
            $registrationdate = $row['registration'];
            $day_left = strtotime(date('Y-m-d h:i:sa'));
            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);
            $extenddatess = ($days + $extenddate);
            $dateextends =date('Y-m-d h:i:sa',strtotime('+'.$extenddatess .'days'));
            $dateextend =date('Y-m-d h:i:sa', strtotime($dateextends));
            $sql = "UPDATE `u952853138_Hunterits`.`details` SET `expiry_date`='$dateextend' where `expiry_date` = '$timemodified1' ";
            // $timemodified1 = date('Y-m-d h:i:sa', strtotime($expiredate));
            // //echo $timemodified1 ."</br>";
            // $dateextends = date('Y-m-d h:i:sa', strtotime($timemodified1 . " + ".$extenddate."days"));
            // $dateextend =date('Y-m-d h:i:sa', strtotime($dateextends));
            // $sql = "UPDATE `u952853138_Hunterits`.`details` SET `expiry_date`='$dateextend' where `expiry_date` = '$timemodified1' ";
            // $CREDITRESULTS = $conn->query($sql);
            if ($conn->query($sql)=== true){
                header('location:admin_id.php?id=success');
                $_SESSION['success'] = "ID Extended Successfully";
                $i++;
            }
        }
       
    }
}
