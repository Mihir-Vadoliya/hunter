<?php
include('admin_head.php');
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
                            <h3 class="card-title">All Super Table</h3>
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
                                                $sql = "SELECT * FROM `credit_log` ORDER by transaction_timestamp DESC";
                                                $result = $con->query($sql);

                                                if (!$result) {
                                                    trigger_error('Invalid query: ' . $con->error);
                                                }
                                                $i = 0;

                                                if ($result->num_rows > 0) {

                                                    while ($row = $result->fetch_assoc()) {

                                                        $i = $i + 1;
                                                        $time = $row["transaction_timestamp"];
                                                        $user_id = $row["transaction_by"];
                                                        $agent_user = $row["transaction_for"];
                                                        $credit = $row["credit_amount"];
                                                        $status = $row["mode"];
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
                                                    echo "0 results";
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