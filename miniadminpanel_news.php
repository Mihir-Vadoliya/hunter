<?php 
include('admin_head.php'); 
include('database/config.php');
date_default_timezone_set("Asia/Kolkata");
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Master Admin Dashboard</h1>
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
              <h3 class="card-title">Enter News </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="row my-2">
                 <form name="confgure" method="POST" action="miniadminpanel_news.php" id="aspnetForm">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="form-group">
                          <label for="clientid" class="form-label mt-4">Enter The News</label>
                             <input type="text" class="form-control" name="miniadminpanel_news" id="panel_news"   aria-describedby="clientid"
                                required placeholder="Enter The News">
                        </div>
                      </div>
                      <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                        <div class="mt-4 py-2">
                          <input type="submit" class="btn btn-info form-control mt-4" name="extend_id" value="ADD NEWS" id="popUpYes">
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
    $id=$_POST["miniadminpanel_news"];
    $sql = "UPDATE soft_news SET news='$id' WHERE  nno = '5' ";
    
    if ($con->query($sql) === TRUE) {
        header('location:miniadminpanel_news.php');
        ?><script>
    
              window.location = 'miniadminpanel_news.php';
              </script>
              <?php
    		exit;
    } else {
        //header('location:login.php?');
    		exit;
    }
}

include('footer.php'); 
?>