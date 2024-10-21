<?php
include('super_head.php');
?>
<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = $_POST["pass"];
    $pass = "jgc" . md5($pass);
    $sn = $_POST["sn"];
    $id = $_POST["id"];
    $sn =  $con->real_escape_string($sn);
    $id =  $con->real_escape_string($id);


    $sql = "UPDATE userinfo SET password='$pass' WHERE  sn=$sn AND p_id='$id' ";

    if ($con->query($sql) === TRUE) {
        $_SESSION['success'] = 'Password Change Successfully';
        header('location:super_seller_list.php');
?><script>
            window.location = 'super_seller_list.php';
        </script>
<?php
        exit;
    } else {
        //header('location:login.php?');
        exit;
    }
}

$sn = $_GET["sn"];
$id = $_GET["id"];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Super Dashboard</h1>
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
                            <h3 class="card-title">Seller Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="row" name="aspnetForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="aspnetForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="clientid" class="form-label mt-4">SELLER NAME</label>
                                            <input type="text" class="form-control" name="id" id="clientid" readonly="readonly" value="<?php echo $id ?>" aria-describedby="clientid" required placeholder="CLIENT ID">
                                            <input type="hidden" class="form-control" name="sn" id="clientid" value="<?php echo $sn ?>" aria-describedby="clientid" required placeholder="CLIENT ID">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label mt-4">Password</label>
                                            <input type="password" class="form-control" name="pass" id="pass" aria-describedby="days" required placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="mt-4 py-2">
                                            <input type="submit" class="btn btn-info form-control mt-4" name="password_change" value="Change Password" id="popUpYes">
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