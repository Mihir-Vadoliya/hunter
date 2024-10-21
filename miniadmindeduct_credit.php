<?php
include('admin_head.php');
?>
<?php



$sn = $_GET["sn"];
$id = $_GET["id"];
?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Master Admin Dashboard</h1>
               <h5 class="tile-title">
                  <?php
                  if (isset($_SESSION['credit_empty'])) {
                     echo $_SESSION['credit_empty'];
                     unset($_SESSION['credit_empty']);
                  }
                  ?>
               </h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="admin_home.php">Home</a></li>
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
                     <h3 class="card-title">Deduct Credit</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form name="confgure" action="miniadmincredit_deduct.php" method="get">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                 <label for="clientid" class="form-label mt-4">ADMIN NAME</label>
                                 <input type="text" class="form-control" name="uid" id="clientid" readonly="readonly" value="<?php echo $id ?>" aria-describedby="clientid" required placeholder="ADMIN NAME">
                                 <input type="hidden" class="form-control" name="sn" id="clientid" value="<?php echo $sn ?>" aria-describedby="clientid" required placeholder="ADMIN ID">
                              </div>
                           </div>
                           <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="form-group">
                                 <label for="exampleInputEmail1" class="form-label mt-4">ADMIN CREDIT</label>
                                 <input type="number" class="form-control" name="num" id="days" aria-describedby="days" required placeholder="Enter Credit">
                              </div>
                           </div>
                           <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                              <div class="mt-4 py-2">
                                 <input type="submit" class="btn btn-info form-control mt-4" name="Configure" value="Update Credit" id="popUpYes">
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
      </div><!--/. container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('footer.php');
?>