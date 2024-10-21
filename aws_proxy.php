<?php
include('database/config.php');
include('seller_head.php');
date_default_timezone_set("Asia/Kolkata");
?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <?php
   $warningmsg = '';
   if (isset($_SESSION['success'])) {
      $warningmsg = $_SESSION['success'];
      unset($_SESSION['success']);
   }
   if (isset($_SESSION['fail'])) {
      $warningmsg = $_SESSION['fail'];
      unset($_SESSION['fail']);
   }
   ?>

   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script type="text/javascript">
   function panValidation() {
      var usersel = $('#selectUser').val();
      if (usersel == "" || usersel == "Select User") {
         alert("Please Select Valid User!");
         return false;
      }
      var multifield = $('#IPaddress').val();
      var fieldlength = multifield.length;
      if (multifield.includes(':') == false) {
         alert("Please Enter Valid Data!");
         return false;
      }
   }
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark"> AWS VPS Active Dashboard</h1>
                <div class="m-0 text-success"><?php echo $warningmsg ?></div>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
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
                     <h3 class="card-title">Add Residential Proxy</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <form class="row g-3" method="post" action="add_user_ip.php" onsubmit="return panValidation();" enctype="multipart/form-data">
                        <div class="col-md-3">
                           <label for="selectUser" class="form-label">Select User</label>
                           <select id="selectUser" name="selectUser" class="form-control">
                              <option selected>Select User</option>
                              <?php
                              if (isset($_SESSION['pan_id'])) {
                                 $pan_id =  $_SESSION['pan_id'];
                                 $query = "SELECT `user_id` FROM `u952853138_Hunterits`.`details` WHERE `agent_user`= '$pan_id' ORDER BY `user_id` ASC";
                                 $results = $conn->prepare($query);
                                 $results->execute();
                                 $i = 0;
                                 while ($rowpan = $results->fetch(PDO::FETCH_ASSOC)) {
                                    foreach ($rowpan as $userid) {
                                       echo "<option name='selectUser'>" . $userid . "</option>";
                                    }
                                    $i++;
                                 }
                              }
                              ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label for="inputCity" class="form-label">Add Residential IP</label>
                           <input type="text" class="form-control" name="IPaddress" id="IPaddress" placeholder="IP:Port:Username:Password" required>
                           <small id="UserName" class="form-text text-warning">Please Input Data Format (000.00.00.00:0000:abcd:abcd123)</small>
                        </div>
                        <div class="col-md-3" style="display:none;">
                           <label for="inputsuperID" class="form-label visually-hidden">Add Residential IP</label>
                           <input type="text" class="form-control visually-hidden" name="LogSuperID" id="LogSuperID" value="<?php echo $pan_id; ?>">
                        </div>
                        <div class="col-md-3">
                           <button type="submit" style="margin-top: 35px;" name="addnew_ip" class="form-control btn btn-primary ">ADD Residential IP</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All Residential Proxy List</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">

                        </div>
                     </div>

                     <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           <div class="table-responsive">
                              <table id="adminTabledata" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>Key</th>
                                       <th>IP</th>
                                       <th>Port</th>
                                       <th>User Name</th>
                                       <th>Password</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if (isset($_SESSION['pan_id'])) {
                                       $pan_id =  $_SESSION['pan_id'];
                                       $query = "SELECT * FROM `u952853138_Hunterits`.`detailsip` WHERE `detsuper_key` = '$pan_id' ";
                                       $results = $conn->prepare($query);
                                       $results->execute();
                                       $i = 0;
                                       while ($rowpan = $results->fetch(PDO::FETCH_ASSOC)) {

                                    ?>
                                          <tr>
                                             <td> <?php echo $rowpan['detusr_key'];  ?></td>
                                             <td><?php echo $rowpan['detusr_ip']; ?></td>
                                             <td><?php echo $rowpan['detusr_port']; ?></td>
                                             <td><?php echo $rowpan['detusr_name']; ?></td>
                                             <td><?php echo $rowpan['detusr_pass']; ?></td>
                                             <td><a class="deletepan" onclick="return deleteConfirm()" href="delete_user.php?id=<?php echo $rowpan['detusr_id'] ?>">Delete</a></td>
                                          </tr>
                                    <?php
                                          $i++;
                                       }
                                    } else {
                                       echo "0 results";
                                    }
                                    ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>Key</th>
                                       <th>IP</th>
                                       <th>Port</th>
                                       <th>User Name</th>
                                       <th>Password</th>
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
<script type='text/javascript'>
   function deleteConfirm() {
      var choice = confirm('Are You Sure Delete This IP?');
      var tagname = document.getElementsByClassName('deletepan');

      if (choice == true) {
         window.location.href = tagname.getAttribute('href');
      } else {
         return false;
      }
   }
</script>