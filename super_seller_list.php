<?php
include('super_head.php');
include('config.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['superid'])) {
   $admin_name = $_SESSION['superid'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM userinfo where super_id = '$admin_name'";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}

$warningmsg = '';
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
               <h1 class="m-0 text-dark">Super Dashboard | <span>Credit: 
                <?php                                 
                   $masteradmincredit = "SELECT * FROM super where sn  = '$admin_name'";
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
                  <li class="breadcrumb-item"><a href="super_home.php">Home</a></li>
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
                     <h3 class="card-title">Create Seller</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form  class="row" action="panel_add.php" method="post">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">SELLER NAME</label>
                                 <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="NameHelp" required placeholder="SELLER NAME">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">SELLER ID</label>
                                 <input type="text" class="form-control" name="userid" id="exampleInputEmail1" aria-describedby="IDHelp" required placeholder="SELLER ID">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <label class="control-label">PASSWORD</label>
                                 <input type="password" class="form-control" name="pass" id="exampleInputEmail1" aria-describedby="IDHelp" required placeholder="Enter Seller Password">
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="mt-4 py-2">
                                 <input class="btn btn-primary form-control" type="submit" value="ADD NEW SELLER">
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

         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Seller Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Total Seller: <?php echo $totalsubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Activate Seller: <?php echo $totalactivesubadmin; ?></h3>

                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Deactivate Seller: <?php echo $totaldeactivesubadmin; ?></h3>
                           </div>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                           <div class="form-group">
                              <h3 class="control-label">Super Credit:<?php echo $credit19; ?></h3>
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
                                       <!--<th>SUPER ID</th>-->
                                       <th>SELLER ID</th>
                                       <!--<th>PASSWORD</th>-->
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL KEYS</th>
                                       <th>Credit Left</th>
                                       <!--<th>Credit Add</th>-->
                                       <!--<th>Credit Deduct</th>-->
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                       $i = 0;
                                       while ($row = $result->fetch_assoc()) {
                                          $sn = $row["sn"];
                                          $wallet = $row["user_credit"];
                                          $sn1 = 'SUPERPANEL' . $i;
                                          $i = $i + 1;
                                          $p_id = $row["p_id"];
                                          $client_name = $row["super_name"];
                                          $pass = $row["password"];
                                          $activated = $row["status"];

                                          if ($activated == 0) {
                                             //$o='activated';
                                             $o = '<center><img src="img/active.png"></center>';
                                             $ol = 'deactivate';
                                             $url = 'super_deactivate.php?sn=' . $sn . '&id=' . $p_id;;
                                          } else {
                                             //$o='deactivated';
                                             $o = '<center><img src="img/deactive.png"></center>';
                                             $ol = 'activate';
                                             $url = 'super_activate.php?sn=' . $sn . '&id=' . $p_id;
                                          }
                                         

                                          $querytotalkey = "SELECT * FROM details where agent_user = '$p_id'"; //"SELECT * FROM details where agent_user in (SELECT p_id FROM userinfo where super_id ='$admin_name')"; 
                                          $resulttoatalkey = $con->query($querytotalkey);
                                          $totalactivesubadminss = mysqli_num_rows($resulttoatalkey);
                                    ?>

                                          <tr>
                                             <td><?php echo $i; ?></td>
                                             <!--<td><?php echo $client_name ?></td>-->
                                             <td> <?php echo $p_id ?></td>
                                             <!--<td><?php echo "**********" ?></td>-->
                                             <td align="center"><a href="change_pass.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE PASSWORD</a></td>
                                             <td><a href="<?php echo $url ?>"><?php echo $o ?></a></td>
                                             <td><?php echo $totalactivesubadminss; ?></td>
                                             <td><?php echo $row["user_credit"] ?></td>
                                             <!--<td><a href="super_pay_add.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a></td>-->
                                             <!--<td><a href="super_pay_deduct.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Deduct Credit</a></td>-->
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
                                       <!--<th>SUPER ID</th>-->
                                       <th>SELLER ID</th>
                                       <!--<th>PASSWORD</th>-->
                                       <th>CHANGE PASSWORD</th>
                                       <th>STATUS</th>
                                       <th>TOTAL KEYS</th>
                                       <th>Credit Left</th>
                                       <!--<th>Credit Add</th>-->
                                       <!--<th>Credit Deduct</th>-->
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