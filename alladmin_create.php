<?php
include('admin_head.php');
include('config.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['adminid'])) {
   $adminnameod = $_SESSION['adminid'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM mini_admin where admin_id = '$adminnameod'";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
   $warningmsg = '';
}

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
               <h1 class="m-0 text-dark">Men Admin Dashboard</h1>
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
                     <h3 class="card-title">Create New Master Admin</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" action="allnewadmin_add.php" method="post">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">MSTER ADMIN NAME</label>
                                 <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="NameHelp" required placeholder="MASTER ADMIN NAME">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">MASTER ADMIN ID</label>
                                 <input type="text" class="form-control" name="userid" id="exampleInputEmail2" aria-describedby="IDHelp" required placeholder="MASTER ADMIN ID">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">PASSWORD</label>
                                 <input type="password" class="form-control" name="pass" id="exampleInputEmai31" aria-describedby="IDHelp" required placeholder="ENTER MASTER ADMIN PASSWORD">

                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="mt-4 py-2">
                                 <input class="btn btn-primary form-control" type="submit" value="ADD NEW MASTER ADMIN">
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
         $queryactive = "SELECT * FROM mini_admin where admin_id = '$adminnameod' and activated = 0 and expiry_date >= '$todaydate'";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM mini_admin where admin_id = '$adminnameod' and activated = 1 and expiry_date >= '$todaydate'";
         $resultdeactive = $con->query($querydeactive);
         $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
         // $creditrow = $resultdeactive->fetch_assoc();
         // $totalcredit = $creditrow['payment'];
         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Master Admin Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                              <h3 class="control-label">Master Admin ID:
                                 <?php echo $totalsubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                              <h3 class="control-label">Activate Master Admin:
                                 <?php echo $totalactivesubadmin; ?></h3>

                           </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                           <div class="form-group">
                              <h3 class="control-label">Deactivate Master Admin:
                                 <?php echo $totaldeactivesubadmin; ?></h3>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           <div class="table-responsive">
                              <table id="adminTabledata" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>NO.</th>
                                       <th>MEN ADMIN ID</th>
                                       <th>MASTER ADMIN ID</th>
                                       <th>REGISTRATION</th>
                                       <th>PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL ADMIN</th>
                                       <th>Credit Left</th>
                                       <th>Add</th>
                                       <th>Deduct</th>
                                       <th>ACTION</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    include('database/config.php');
                                    if (isset($_SESSION['adminid'])) {
                                       $admin_id = $_SESSION['adminid'];
                                       $queryadmin = "SELECT * FROM `u952853138_Hunterits`.`admin` WHERE `an`= '$admin_id' LIMIT 1";
                                       $resultsadmin = $conn->prepare($queryadmin);
                                       $resultsadmin->execute();
                                       $rowsadmin = $resultsadmin->fetch(PDO::FETCH_ASSOC);
                                       $adminname = $rowsadmin['admin_id'];
                                    }
                                    if ($result->num_rows > 0) {
                                       $i = 0;
                                       while ($row = $result->fetch_assoc()) {
                                          $sn = $row["mini_id"];
                                          $wallet = $row["admin_id"];
                                          $sn1 = 'SUPERPANEL' . $i;
                                          $i = $i + 1;
                                          $p_id = $row["mini_admin_id"];
                                          $client_name = $row["mini_username"];
                                          $pass = $row["password"];
                                          $activated = $row["activated"];
                                          $payment = $row["payment"];
                                          $regitrationdate = $row['registration'];
                                          $regitration = date('Y-m-d', strtotime($regitrationdate));


                                          if ($activated == 0) {

                                             $o = '<center><img src="img/active.png"></center>';
                                             $ol = 'deactivate';
                                             $url = 'adminself_deactivate.php?sn=' . $sn . '&id=' . $p_id;
                                          } else {
                                             //$o='deactivated';
                                             $o = '<center><img src="img/deactive.png"></center>';
                                             $ol = 'activate';
                                             $url = 'adminself_activate.php?sn=' . $sn . '&id=' . $p_id;
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
                                          $querytotalkey = "SELECT * FROM sub_admin where mini_admin_id = '$sn'";
                                          $resulttoatalkey = $con->query($querytotalkey);
                                          $totalactivesupper = mysqli_num_rows($resulttoatalkey);

                                          $delete='allminiadmin_delete.php?sn='.$sn.'&id='.$p_id;


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
                                             <td>
                                                <?php echo $adminname; ?>
                                             </td>
                                             <td><?php echo $p_id ?></td>
                                             <td>
                                                <?php echo $regitration ?>
                                             </td>
                                             <td><a href="adminchnge_password.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE
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
                                             <td><a href="miniadminadd_credit.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a>
                                             </td>
                                             <td><a href="miniadmindeduct_credit.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Deduct Credit</a>
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
                                       <th>NO.</th>
                                       <th>MEN ADMIN ID</th>
                                       <th>MASTER ADMIN ID</th>
                                       <th>REGISTRATION</th>
                                       <th>PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL MINI ADMIN</th>
                                       <th>Credit Left</th>
                                       <th>Add</th>
                                       <th>Deduct</th>
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