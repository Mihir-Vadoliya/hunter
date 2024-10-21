<?php
include('mini_admin_head.php');
include('config.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['miniadmin_id'])) {
   $adminnameod = $_SESSION['miniadmin_id'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM sub_admin where mini_admin_id = '$adminnameod'";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}
$warningmsg ='';

if (isset($_SESSION['success'])) {
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">MasterAdmin Dashboard | <span>Credit: 
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
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Create New Admin</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form class="row" action="subadmin_addin_mini_admin.php" method="post">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">ADMIN NAME</label>
                                 <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="NameHelp" required placeholder="ADMIN NAME">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">ADMIN ID</label>
                                 <input type="text" class="form-control" name="userid" id="exampleInputEmail2" aria-describedby="IDHelp" required placeholder="ADMIN ID">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">PASSWORD</label>
                                 <input type="password" class="form-control" name="pass" id="exampleInputEmai31" aria-describedby="IDHelp" required placeholder="ENTER ADMIN PASSWORD">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="mt-4 py-2">
                                 <input class="btn btn-primary form-control" type="submit" value="ADD NEW ADMIN">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.card-body -->
                  </form>
               </div>
            </div>
         </div>
         <!-- /.row -->

         <?php
         $queryactive = "SELECT * FROM sub_admin where mini_admin_id= '$adminnameod' and 	activated = 0 and expiry_date >= '$todaydate'";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM sub_admin where mini_admin_id = '$adminnameod' and activated = 1 and expiry_date >= '$todaydate'";
         $resultdeactive = $con->query($querydeactive);
         $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
         // $creditrow = $resultdeactive->fetch_assoc();
         // $totalcredit = $creditrow['payment'];
         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Admin Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Admin ID:
                                 <?php echo $totalsubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Activate Admin:
                                 <?php echo $totalactivesubadmin; ?></h3>

                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Deactivate Admin:
                                 <?php echo $totaldeactivesubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              
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
                                       <!--<th>MASTER ADMIN</th>-->
                                       <th>ADMIN ID</th>
                                       <th>REGISTRATION DATE</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SUPER</th>
                                       <th>Credit Left</th>
                                       <th>Credit Add</th>
                                       <th>Credit Deduct</th>
                                       <th>ACTION</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    include('database/config.php');
                                    if (isset($_SESSION['miniadmin_id'])) {
                                       $admin_id = $_SESSION['miniadmin_id'];
                                       $queryadmin = "SELECT * FROM `u952853138_Hunterits`.`mini_admin` WHERE `mini_id`= '$admin_id' LIMIT 1";
                                       $resultsadmin = $conn->prepare($queryadmin);
                                       $resultsadmin->execute();
                                       $rowsadmin = $resultsadmin->fetch(PDO::FETCH_ASSOC);
                                       $adminname = $rowsadmin['mini_admin_id'];
                                    }
                                    if ($result->num_rows > 0) {
                                       $i = 0;
                                       while ($row = $result->fetch_assoc()) {
                                          $sn = $row["san"];
                                          $wallet = $row["admin_id"];
                                          $sn1 = 'SUPERPANEL' . $i;
                                          $i = $i + 1;
                                          $p_id = $row["sub_admin_id"];
                                          $client_name = $row["username"];
                                          $pass = $row["password"];
                                          $activated = $row["activated"];
                                          $payment = $row["payment"];
                                          $regitrationdate = $row['registration'];


                                          if ($activated == 0) {

                                             $o = '<center><img src="img/active.png"></center>';
                                             $ol = 'deactivate';
                                             $url = 'subadmin_deactivein_miniadmin.php?sn=' . $sn . '&id=' . $p_id;
                                          } else {
                                             //$o='deactivated';
                                             $o = '<center><img src="img/deactive.png"></center>';
                                             $ol = 'activate';
                                             $url = 'subadmin_activein_miniadmin.php?sn=' . $sn . '&id=' . $p_id;
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
                                          $querytotalkey = "SELECT * FROM super where sub_admin_id ='$sn' ";
                                          $resulttoatalkey = $con->query($querytotalkey);
                                          $totalactivesupper = mysqli_num_rows($resulttoatalkey);

                                          $delete = 'subadmin_deletein_miniadmin.php?sn=' . $sn . '&id=' . $p_id;

                                          if (isset($_GET['changedemostatuson'])) {
                                             header("Location:admin_home.php");
                                             $seller_id = $_GET['id'];
                                             $todate = date('Y-m-d h:i:sa');
                                             $paymentstm = "UPDATE `demoswitch` SET `status`='Active' WHERE `switch_id`='1'";
                                             $result = mysqli_query($con, $paymentstm);
                                          }

                                          if (isset($_GET['changedemostatusoff'])) {
                                             header("Location:admin_home.php");
                                             $seller_id = $_GET['id'];
                                             $todate = date('Y-m-d h:i:sa');
                                             $paymentstm = "UPDATE `demoswitch` SET `status`='Deactive' WHERE `switch_id`='1'";
                                             $result = mysqli_query($con, $paymentstm);
                                          }
                                    ?>



                                          <tr>
                                             <td>
                                                <?php echo $i; ?>
                                             </td>
                                             <!--<td>-->
                                             <!--   <?php echo $adminname; ?>-->
                                             <!--</td>-->
                                             <td><?php echo $p_id ?> </td>
                                             <td>
                                                <?php echo $regitrationdate ?>
                                             </td>
                                             <td><a href="subadmin_passchangein_admin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE
                                                   PASSWORD</a></td>
                                             <td><a href="<?php echo $url ?>">
                                                   <?php echo $o ?>
                                                </a>
                                             <td>
                                                <?php echo $totalactivesupper; ?>
                                             </td>
                                             <td>
                                                <?php echo $payment ?>
                                             </td>
                                             <td><a href="subadd_creditin_miniadmin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a>
                                             </td>
                                             <td><a href="subdeduct_miniadmin.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Deduct Credit</a>
                                             </td>
                                             <td><a onclick="return chcekcreate();" href="<?php echo $delete ?>">Delete ID</a></td>
                                          </tr>
                                    <?php
                                       }

                                       //agent_user, user_id, client_name, status, user_type,mac, registration, admin_msg, payment, expiry_date, activated

                                    } else {
                                       echo "0 results";
                                    }

                                    ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>SERIAL NO.</th>
                                       <!--<th>MASTER ADMIN</th>-->
                                       <th>ADMIN ID</th>
                                       <th>REGISTRATION DATE</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SUPER</th>
                                       <th>Credit Left</th>
                                       <th>Credit Add</th>
                                       <th>Credit Deduct</th>
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