<?php
include('sub_admin_head.php');
date_default_timezone_set("Asia/Calcutta");
$warningmsg = '';
if (isset($_SESSION['success'])) {
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);
}

if (isset($_SESSION['subid'])) {
   $subadmin_name =  $_SESSION['subid'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM super where 	sub_admin_id = '$subadmin_name'";
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
               <h1 class="m-0 text-dark">Admin Dashboard | <span>Credit: 
                <?php                                 
                   $masteradmincredit = "SELECT * FROM sub_admin where san  = '$subadmin_name'";
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
                  <li class="breadcrumb-item"><a href="subadmin_dashboard.php">Home</a></li>
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
                     <h3 class="card-title">Create Super</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form class="row" action="superpanel_add.php" method="post">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">SUPER NAME</label>
                                 <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="NameHelp" required placeholder="SUPER NAME">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">SUPER ID</label>
                                 <input type="text" class="form-control" name="userid" id="exampleInputEmail1" aria-describedby="IDHelp" required placeholder="SUPER ID">
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
                                 <input type="submit" class="btn btn-info form-control" value="ADD SUPER" id="popUpYes">
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

         <?PHP
         $queryactive = "SELECT * FROM super where status = 0 and sub_admin_id = '$subadmin_name'";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM super where status = 1 and sub_admin_id = '$subadmin_name'";
         $resultdeactive = $con->query($querydeactive);
         $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
         // $creditrow = $resultdeactive->fetch_assoc();
         // $totalcredit = $creditrow['payment'];

         $credit19 = 0;
         $sql19 = "SELECT * FROM sub_admin where san  = '$subadmin_name'";
         $result19 = $con->query($sql19);
         while ($row = $result19->fetch_assoc()) {
            $credit19 = $row["payment"];
         }

         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Super Table</h3>
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
                              <h3 class="control-label">Admin Credit:<?php echo $credit19; ?></h3>
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
                                       <!--<th>ADMIN ID</th>-->
                                       <th>SUPER ID</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SELLER</th>
                                       <th>Credit Left</th>
                                       <th>Credit Add</th>
                                       <th>Credit Deduct</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if ($con->connect_error) {
                                       die("Connection failed: " . $con->connect_error);
                                    }
                                    $a_name = $_SESSION['info']['username'];
                                    $sql = "SELECT * FROM super where sub_admin_id = '$subadmin_name' ";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                       // output data of each row
                                       $i = 0;
                                       while ($row = $result->fetch_assoc()) {
                                          //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
                                          $sn = $row["sn"];
                                          $wallet = $row["admin_name"];
                                          $sn1 = 'SUPERPANEL' . $i;
                                          $i = $i + 1;
                                          $p_id = $row["s_id"];
                                          $client_name = $row["admin_name"];
                                          $pass = $row["password"];
                                          $activated = $row["status"];
                                          $payment = $row["payment"];
                                          //diff time stamp giving same time
                                          $sql1 = "SELECT * FROM userinfo where super_name='$p_id'";
                                          $rowcount = 0;
                                          if ($result1 = mysqli_query($con, $sql1)) {
                                             // Return the number of rows in result set
                                             $rowcount = mysqli_num_rows($result1);

                                             // Free result set
                                             mysqli_free_result($result1);
                                          }


                                          if ($activated == 0) {
                                             //$o='activated';
                                             $o = '<center><img src="img/active.png"></center>';
                                             $ol = 'deactivate';
                                             $url = 'sub_admin_home_deactivate.php?sn=' . $sn . '&id=' . $p_id;;
                                          } else {
                                             //$o='deactivated';
                                             $o = '<center><img src="img/deactive.png"></center>';
                                             $ol = 'activate';
                                             $url = 'sub_admin_home_activate.php?sn=' . $sn . '&id=' . $p_id;
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

                                    ?>
                                          <tr>
                                             <td><?php echo $i; ?></td>
                                             <!--<td><?php echo $client_name ?></td>-->
                                             <td> <?php echo $p_id ?></td>
                                             <td><a href="sub_super_change_password.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE PASSWORD</a></td>
                                             <td><a href="<?php echo $url ?>"><?php echo $o ?></a>
                                             <td><?php echo $rowcountlb ?></td>
                                             <td><?php echo $payment ?></td>
                                             <td><a href="sub_admin_add.php?id=<?php echo $p_id ?>&sn=<?php echo $sn; ?>">Add Credit</a></td>
                                             <td><a href="subadmin_supercredit_deduct.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Delete Credit</a></td>
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
                                       <!--<th>ADMIN ID</th>-->
                                       <th>SUPER ID</th>
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL SELLER</th>
                                       <th>Credit Left</th>
                                       <th>Credit Add</th>
                                       <th>Credit Deduct</th>
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