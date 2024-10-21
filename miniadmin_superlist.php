<?php
include('mini_admin_head.php');
date_default_timezone_set("Asia/Calcutta");
$warningmsg =' ';
if (isset($_SESSION['success'])) {   
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);   
}

if (isset($_SESSION['miniadmin_id'])) {
   $adminnameod = $_SESSION['miniadmin_id'];
}

if (isset($_SESSION['miniadmin_id'])) {
   $admin_name = $_SESSION['miniadmin_id'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM super where sub_admin_id	in (SELECT san FROM sub_admin Where mini_admin_id = '$admin_name')";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">MasterAdmin Dashboard |  <span>Credit: 
               <?php                                 
                   $masteradmincredit = "Select * from `mini_admin` where `mini_id` ='$adminnameod' ";
                   $resultcreditmasteradmin = $con->query($masteradmincredit);
                   while ($rowcreditasteradmin = $resultcreditmasteradmin->fetch_assoc()) {
                		$creditmasteradmin = $rowcreditasteradmin["payment"];
                	}
                 echo $creditmasteradmin;
                 ?>
               </span></h1>
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
         <!-- Info boxes -->

         <?PHP
         $queryactive = "SELECT * FROM super where status = 0 and sub_admin_id	in (SELECT san FROM sub_admin Where mini_admin_id = '$admin_name')";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM super where status = 1 and sub_admin_id	in (SELECT san FROM sub_admin Where mini_admin_id = '$admin_name')";
         $resultdeactive = $con->query($querydeactive);
         $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
         // $creditrow = $resultdeactive->fetch_assoc();
         // $totalcredit = $creditrow['payment'];

         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Sper Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Total Super: <?php echo $totalsubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Activate Super: <?php echo $totalactivesubadmin; ?></h3>

                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Deactivate Super: <?php echo $totaldeactivesubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Today Create Super:
                                 <?php
                                 //include('database/config.php'); 
                                 $todaydate =  date('Y-m-d');
                                 $querytores = "SELECT * FROM `super` where sub_admin_id in (SELECT san FROM sub_admin Where mini_admin_id = '$admin_name')";
                                 $resulttores = $con->query($querytores);
                                 $counttores =  mysqli_num_rows($resulttores);

                                 if ($counttores > 0) {
                                    $i = 0;
                                    while ($rowpantores = $resulttores->fetch_assoc()) {

                                       $regdate =  $rowpantores['registration'];
                                       $registrationdate = date("Y-m-d", strtotime($regdate));
                                       if ($todaydate == $registrationdate) {
                                          $i++;
                                       }
                                    }
                                    echo $i;
                                 }


                                 ?></h3>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           <div class="table-responsive">
                              <table id="adminTabledata" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>SERIAL NO.</th>
                                       <th>ADMIN ID</th>
                                       <th>SUPER ID</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SELLER</th>
                                       <th>Credit Left</th>
                                       <!--<th>Credit Add</th>-->
                                       <!--<th>Credit Deduct</th>-->
                                       <th>ACTION</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                       $i = 0;
                                       while ($row = $result->fetch_assoc()) {
                                          $sn = $row["sn"];
                                          $wallet = $row["admin_id"];
                                          $i = $i + 1;
                                          $p_id = $row["s_id"];
                                          $client_name = $row["admin_name"];
                                          $pass = $row["password"];
                                          $activated = $row["status"];
                                          $payment = $row["payment"];

                                          if ($activated == 0) {

                                             $o = '<center><img src="img/active.png"></center>';
                                             $ol = 'deactivate';
                                             $url = 'superdeactivatein_miniadmin.php?sn=' . $sn . '&id=' . $p_id;
                                          } else {
                                             //$o='deactivated';
                                             $o = '<center><img src="img/deactive.png"></center>';
                                             $ol = 'activate';
                                             $url = 'superactivatein_miniadmin.php?sn=' . $sn . '&id=' . $p_id;
                                          }

                                          if ($payment == 1) {
                                             $n = 'bgcolor="#00FF00"';
                                             $ns = 'PAID';
                                             $url1 = 'admin_payment_due.php?sn=' . $sn . '&id=' . $p_id;
                                          } else {
                                             $n = 'bgcolor="#F00"';
                                             $ns = 'DUE';
                                             $url1 = 'admin_payment_paid.php?sn=' . $sn . '&id=' . $p_id;
                                          }
                                          $sqllb = "SELECT * FROM userinfo where super_id='$sn'";
                                          $resultlb = $con->query($sqllb);
                                          $rowcountlb = mysqli_num_rows($resultlb);


                                          $delete = 'superdelete_inminiadmin.php?sn=' . $sn . '&id=' . $p_id;
                                    ?>
                                          <tr>
                                             <td><?php echo $i; ?></td>
                                             <td><?php echo $client_name ?></td>
                                             <td> <?php echo $p_id ?></td>
                                             <td><a href=" superchange_passin_miniadmin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE PASSWORD</a></td>
                                             <td><a href="<?php echo $url ?>"><?php echo $o ?></a>
                                             <td><?php echo $rowcountlb ?></td>
                                             <td><?php echo $payment ?></td>
                                             <!--<td><a href="superaddcredit_inminiadmin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a></td>-->
                                             <!--<td><a href="superdeductcredit_inminiadmin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Deduct Credit</a></td>-->
                                             <td><a onclick="return chcekcreate();" href="<?php echo $delete ?>">Delete ID</a></td>
                                          </tr>
                                    <?php
                                       }
                                    } else {
                                       echo "0 results";
                                    }


                                    ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>SERIAL NO.</th>
                                       <th>ADMIN ID</th>
                                       <th>SUPER ID</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SELLER</th>
                                       <th>Credit Left</th>
                                       <!--<th>Credit Add</th>-->
                                       <!--<th>Credit Deduct</th>-->
                                       <th>ACTION</th>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>
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