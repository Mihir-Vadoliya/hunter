<?php
include('super_head.php');
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
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Transection Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table id="adminTabledata" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Owner</th>
                                                    <th>Customer</th>
                                                    <th>Credit</th>
                                                    <th>Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                //include('config.php'); 


                                                $name123 = $_SESSION['info']['s_id'];

                                                if (isset($_SESSION['superid'])) {
                                                    $sumerid = $_SESSION['superid'];
                                                }

                                                $sql = "SELECT * FROM `credit_log` where super_id='$sumerid' ORDER by transaction_timestamp DESC";
                                                //echo $sql;
                                                $result = $con->query($sql);

                                                if (!$result) {
                                                    trigger_error('Invalid query: ' . $con->error);
                                                }
                                                $i = 0;
                                                //$sql = "SELECT * FROM details";
                                                //$result = $con->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
                                                        $i = $i + 1;
                                                        $time = $row["transaction_timestamp"];
                                                        $user_id = $row["transaction_by"];
                                                        $agent_user = $row["transaction_for"];
                                                        $credit = $row["credit_amount"];
                                                        $status = $row["mode"];

                                                        //   

                                                ?>


                                                        <tr>
                                                            <td><?php echo $time ?></td>
                                                            <td><?php echo $user_id ?></td>
                                                            <td><?php echo $agent_user ?></td>
                                                            <td><?php echo $credit ?></td>
                                                            <td><?php echo $status ?></td>
                                                        </tr>
                                                <?php


                                                    }
                                                } else {
                                                    echo " ";
                                                }


                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Owner</th>
                                                    <th>Customer</th>
                                                    <th>Credit</th>
                                                    <th>Mode</th>
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