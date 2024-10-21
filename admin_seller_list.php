<?php
include('admin_head.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['adminid'])) {
   $admin_name = $_SESSION['adminid'];
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM userinfo";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}
$warningmsg = '';
if (isset($_SESSION['success'])) {
   $warningmsg = $_SESSION['success'];
   unset($_SESSION['success']);
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <?PHP
   $queryactive = "SELECT * FROM userinfo where status = 0";
   $resultactive = $con->query($queryactive);
   $totalactivesubadmin = mysqli_num_rows($resultactive);

   $querydeactive = "SELECT * FROM userinfo where status = 1";
   $resultdeactive = $con->query($querydeactive);
   $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
   // $creditrow = $resultdeactive->fetch_assoc();
   // $totalcredit = $creditrow['payment'];

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
      <?PHP
      $queryactive = "SELECT * FROM userinfo where status = 0";
      $resultactive = $con->query($queryactive);
      $totalactivesubadmin = mysqli_num_rows($resultactive);

      $querydeactive = "SELECT * FROM userinfo where status = 1";
      $resultdeactive = $con->query($querydeactive);
      $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
      // $creditrow = $resultdeactive->fetch_assoc();
      // $totalcredit = $creditrow['payment'];

      ?>
      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
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
                                 <h3 class="control-label">Total Seller: <?php echo $totalsubadmin; ?></h3>
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <h3 class="control-label">Active Seller: <?php echo $totalactivesubadmin; ?></h3>

                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <h3 class="control-label">Deactive Seller: <?php echo $totaldeactivesubadmin; ?></h3>
                              </div>
                           </div>
                           <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                              <div class="form-group">
                                 <h3 class="control-label">
                                    Today Create Seller:
                                    <?php
                                    include('database/config.php');
                                    $todaydate =  date('Y-m-d');
                                    $querytores = "SELECT * FROM `userinfo`";
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


                                    ?>
                                 </h3>
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
                                          <th>MASTER ADMIN ID</th>
                                          <th>ADMIN ID</th>
                                          <th>SUPER ID</th>
                                          <th>SELLER ID</th>
                                          <th>CHANGE PASSWORD</th>
                                          <th>STATUS</th>
                                          <th>TOTAL KEYS</th>
                                          <th>Credit Left</th>
                                          <th>Add Credit</th>
                                          <th>Delete Credit</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       //$m=$_SESSION['info']['s_id'];
                                       //echo $m;
                                       //echo "mad";
                                       $sql = "SELECT * FROM userinfo";
                                       $result = $con->query($sql);

                                       if ($result->num_rows > 0) {
                                          // output data of each row
                                          $i = 1;
                                          $srl = 0;
                                          while ($row = $result->fetch_assoc()) {
                                             //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
                                             $sn = $row["sn"];
                                             $sn1 = 'PANEL' . $i;                                             
                                             $i = $i + 1;
                                             $p_id = $row["p_id"];
                                             $client_name = $row["super_name"];
                                             $pass = $row["password"];
                                             $activated = $row["status"];
                                             //diff time stamp giving same time
                                             $sql1 = "SELECT * FROM details where agent_user='$p_id'";
                                             $rowcount = 0;
                                             if ($result1 = mysqli_query($con, $sql1)) {
                                                // Return the number of rows in result set
                                                $rowcount = mysqli_num_rows($result1);

                                                // Free result set
                                                mysqli_free_result($result1);
                                             }

                                             //super unpaid
                                             $sql17 = "SELECT * FROM details where agent_user='$p_id' AND status=0";
                                             $result17 = $con->query($sql17);
                                             $rowcount17 = mysqli_num_rows($result17);
                                             //receive amount
                                             $sql18 = "SELECT * FROM details where agent_user='$p_id' AND super_pay=0";
                                             $result18 = $con->query($sql18);
                                             $rowcount18 = mysqli_num_rows($result18);
                                             $srl++;




                                             if ($activated == 0) {
                                                //$o='activated';
                                                $o = '<center><img src="img/active.png"></center>';
                                                $ol = 'deactivate';
                                                $url = 'admin_super_deactivate.php?sn=' . $sn . '&id=' . $p_id;;
                                             } else {
                                                //$o='deactivated';
                                                $o = '<center><img src="img/deactive.png"></center>';
                                                $ol = 'activate';
                                                $url = 'admin_super_activate.php?sn=' . $sn . '&id=' . $p_id;
                                             }
                                             /* if ($activated == 0) {
                                                $o='ACTIVATED';
                                                $ol='DEACTIVE';
                                                $url='super_deactivate.php?sn='.$sn.'&id='.$p_id ;
                                                ;
                                                } else {
                                                   $o='DEACTIVATED';
                                                   $ol='ACTIVATE';
                                                   $url='super_activate.php?sn='.$sn.'&id='.$p_id;
                                                   }
                                             */
                                             $delete = 'seller_delete.php?sn=' . $sn . '&id=' . $p_id;;
                                       ?>
                                             <tr>
                                                <td><?php echo $srl; ?></td>
                                                <td><?php $masteradminid = "Select * from mini_admin where mini_id  in(SELECT mini_admin_id FROM sub_admin where san in (SELECT sub_admin_id  FROM super where sn in (SELECT super_id FROM userinfo where sn =' $sn')))";
                                                      $masteradminresult = $con->query($masteradminid);
                                                      $masteradminrow = $masteradminresult->fetch_assoc();
                                                      echo $masteradminrow['mini_admin_id'];
                                                      ?></td>
                                                <td><?php $miniid = "SELECT * FROM sub_admin where san in (SELECT sub_admin_id  FROM super where sn in (SELECT super_id FROM userinfo where sn =' $sn'))";
                                                      $miniadminresult = $con->query($miniid);
                                                      $miniadminrow = $miniadminresult->fetch_assoc();
                                                      echo $miniadminrow['sub_admin_id'];
                                                      ?></td>
                                                <td><?php echo $client_name ?></td>
                                                <td> <?php echo $p_id ?></td>
                                                <td><a href="seller_change_pass.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE PASSWORD</a></td>
                                                <td><a href="<?php echo $url ?>"><?php echo $o ?></a></td>
                                                <td><?php echo $rowcount ?></td>
                                                <td><?php echo $row["user_credit"] ?></td>
                                                <td><a href="seller_credit_add.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a></td>
                                                <td><a href="seller_credit_delete.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Deduct Credit</a></td>
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
                                          <th>MASTER ADMIN ID</th>
                                          <th>ADMIN ID</th>
                                          <th>SUPER ID</th>
                                          <th>SELLER ID</th>
                                          <th>CHANGE PASSWORD</th>
                                          <th>STATUS</th>
                                          <th>TOTAL KEYS</th>
                                          <th>Credit Left</th>
                                          <th>Add Credit</th>
                                          <th>Delete Credit</th>
                                          <th>Action</th>
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
   <script>
      function chcekcreate() {
         return confirm('Are You Want To Delete ?');
      }
   </script>