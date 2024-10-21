<?php
include('admin_head.php');
include('config.php');
date_default_timezone_set("Asia/Calcutta");
if (isset($_SESSION['adminid'])) {
    $adminnameod = $_SESSION['adminid'];
    $todaydate = date('Y-m-d h:i:sa');
    $queryres = "SELECT * FROM sub_admin";
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            <?php
            $queryactive = "SELECT * FROM sub_admin where activated = 0 and expiry_date >= '$todaydate'";
            $resultactive = $con->query($queryactive);
            $totalactivesubadmin = mysqli_num_rows($resultactive);

            $querydeactive = "SELECT * FROM sub_admin where activated = 1 and expiry_date >= '$todaydate'";
            $resultdeactive = $con->query($querydeactive);
            $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
            // $creditrow = $resultdeactive->fetch_assoc();
            // $totalcredit = $creditrow['payment'];
            ?>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">All Admin Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <h3 class="control-label">Admin ID:
                                            <?php echo $totalsubadmin; ?>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <h3 class="control-label">Activate Admin:
                                            <?php echo $totalactivesubadmin; ?></h3>

                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <h3 class="control-label">Deactivate Admin:
                                            <?php echo $totaldeactivesubadmin; ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <table id="adminTabledata" class="table table-bordered table-striped display">
                                            <thead>
                                                <tr>
                                                    <th>SERIAL NO.</th>
                                                    <th>MASTER ADMIN ID</th>
                                                    <th>ADMIN ID</th>
                                                    <th>REGISTRATION DATE</th>
                                                    <th>CHANGE PASSWORD</th>
                                                    <th>STATUS</th>
                                                    <th>TOTAL SUPER</th>
                                                    <th>Credit Left</th>
                                                    <th>Credit Add</th>
                                                    <th>Credit Deduct</th>
                                                    <th>ACTION</th>
                                                    <th>Paid Button</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    $i = 0;
                                                    while ($row = $result->fetch_assoc()) {
                                                        $sn = $row["san"];
                                                        $wallet = $row["admin_id"];
                                                        $sn1 = 'SUPERPANEL' . $i;
                                                        $i = $i + 1;
                                                        $p_id = $row["sub_admin_id"];
                                                        $buttonstatus = $row['paid_button'];
                                                        $client_name = $row["username"];
                                                        $pass = $row["password"];
                                                        $activated = $row["activated"];
                                                        $payment = $row["payment"];
                                                        $regitrationdate = $row['registration'];
                                                        $regitrationdate = date("d-m-Y", strtotime($regitrationdate));
                                                        $miniadminname = $row['mini_admin_id'];
                                                        $adminidinsub = $row['admin_id'];
                                                        
                                                        $queryadmin = "SELECT * FROM admin WHERE an= '$adminidinsub' LIMIT 1";
                                                        $resultsadmin = $con->query($queryadmin);
                                                        $rowsadmin =  $resultsadmin->fetch_assoc();
                                                        $adminname = $rowsadmin['admin_id'];


                                                        $queryminiadmin = "SELECT * FROM mini_admin WHERE mini_id= '$miniadminname' LIMIT 1";
                                                        $resultsminiadmin = $con->query($queryminiadmin);
                                                        $rowsminiadmin =  $resultsminiadmin->fetch_assoc();
                                                        $miniadminname = $rowsminiadmin['mini_admin_id'];


                                                        if ($activated == 0) {

                                                            $o = '<center><img src="img/active.png"></center>';
                                                            $ol = 'deactivate';
                                                            $url = 'sub_admin_deactivate.php?sn=' . $sn . '&id=' . $p_id;
                                                        } else {
                                                            //$o='deactivated';
                                                            $o = '<center><img src="img/deactive.png"></center>';
                                                            $ol = 'activate';
                                                            $url = 'sub_admin_activate.php?sn=' . $sn . '&id=' . $p_id;
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
                                                        $querytotalkey = "SELECT * FROM super where sub_admin_id = '$sn'";
                                                        $resulttoatalkey = $con->query($querytotalkey);
                                                        $totalactivesupper = mysqli_num_rows($resulttoatalkey);

                                                        $delete = 'sub_admin_delete.php?sn=' . $sn . '&id=' . $p_id;;

                                                        if (isset($_GET['changepaidbuttonon'])) {
                                                            $miniadmin_id = $_GET['san'];
                                                            $paymentstm = "UPDATE sub_admin SET paid_button=1 WHERE san='$miniadmin_id'";
                                                            if ($con->query($paymentstm) === TRUE) {                                                              
                                                               
                                                            } else {
                                                                header('location:subadmin_create.php');
                                                            }
                                                        }

                                                        if (isset($_GET['changepaidbuttonoff'])) {
                                                            $miniadmin_id = $_GET['san'];
                                                            $paymentstm = "UPDATE sub_admin SET paid_button=0 WHERE san='$miniadmin_id'";
                                                            if ($con->query($paymentstm) === TRUE) {
                                                                                                                         
                                                            } else {
                                                                header('location:subadmin_create.php');
                                                                $_SESSION['success'] = 'Paid Button Active Successfully!';
                                                            }
                                                        }

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
                                                                <?php
                                                                if ($adminname != '') {
                                                                    echo $adminname;
                                                                } else {

                                                                    echo $miniadminname;
                                                                }

                                                                ?>
                                                            </td>
                                                            <td><a type="button" class="text-danger" data-toggle="modal" data-target="#subadminModal<?php echo $p_id . time() ?>">
                                                                    <?php echo $p_id ?>
                                                                </a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="subadminModal<?php echo $p_id . time() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" style="max-width:1200px !important; height:auto;" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                                    <?php echo $p_id ?>
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="alert alert-dismissible alert-secondary">
                                                                                    <div class="container">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-3 col-md-3">
                                                                                                <h4>Total Seller ID:
                                                                                                    <?php
                                                                                                    $queryallseller = "SELECT * FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id  = '$sn')";
                                                                                                    $resultallseller = $con->query($queryallseller);
                                                                                                    $totalaallseller = mysqli_num_rows($resultallseller);
                                                                                                    echo $totalaallseller;
                                                                                                    ?>
                                                                                                </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-3 col-md-3">
                                                                                                <h4>Total ID:

                                                                                                    <?php
                                                                                                    $queryallid = "SELECT * FROM details where agent_user in (SELECT p_id FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id  = '$sn'))";
                                                                                                    $resultallid = $con->query($queryallid);
                                                                                                    $totalaallid = mysqli_num_rows($resultallid);
                                                                                                    echo $totalaallid;
                                                                                                    ?>

                                                                                                </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-3 col-md-3">
                                                                                                <h4>Total Paid ID:
                                                                                                    <?php
                                                                                                    $queryallpaidid = "SELECT * FROM details where admin_pay = 1 && agent_user in (SELECT p_id FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id  = '$sn'))";
                                                                                                    $resultallpaidid = $con->query($queryallpaidid);
                                                                                                    $totalaallpaidid = mysqli_num_rows($resultallpaidid);
                                                                                                    echo $totalaallpaidid;
                                                                                                    ?>

                                                                                                </h4>
                                                                                            </div>
                                                                                            <div class="col-sm-3 col-md-3">
                                                                                                <h4>Total Unpaid ID:
                                                                                                    <?php
                                                                                                    $queryallpaidid = "SELECT * FROM details where admin_pay = 0 && agent_user in (SELECT p_id FROM userinfo where super_id in (SELECT sn FROM super where sub_admin_id  = '$sn'))";
                                                                                                    $resultallpaidid = $con->query($queryallpaidid);
                                                                                                    $totalaallpaidid = mysqli_num_rows($resultallpaidid);
                                                                                                    echo $totalaallpaidid;
                                                                                                    ?>
                                                                                                </h4>
                                                                                            </div>
                                                                                        </div>
                                                                                       
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                $("#selectSuper<?php echo $p_id . time() ?>").change(function() {
                                                                                                    var superID = $(this).val();
                                                                                                    if (superID != 'Select Supper ID' || '') {

                                                                                                        $.ajax({
                                                                                                            url: 'allselleridfetch.php',
                                                                                                            type: 'post',
                                                                                                            data: 'super_id=' + superID,
                                                                                                            dataType: 'json',
                                                                                                            success: function(response) {

                                                                                                                var len = response.length;

                                                                                                                $("#selectUser<?php echo $p_id . time() ?>").empty();
                                                                                                                $("#selectUser<?php echo $p_id . time() ?>").append("<option selected>Select Seller ID</option>");
                                                                                                                for (var i = 0; i < len; i++) {
                                                                                                                    var id = response[i]['id'];
                                                                                                                    var name = response[i]['name'];

                                                                                                                    $("#selectUser<?php echo $p_id . time() ?>").append("<option value='" + id + "'>" + name + "</option>");

                                                                                                                }
                                                                                                            }
                                                                                                        });
                                                                                                    } else {
                                                                                                        $('#selectUser<?php echo $p_id . time() ?>').html('<option value="0">Seller ID Empty</option>');
                                                                                                    }
                                                                                                });

                                                                                            });
                                                                                        </script>
                                                                                        <div class="row form-group mt-3">
                                                                                            <label for="select" class="col-md-4 col-sm-4 control-label">
                                                                                                <h4>Total Supper ID: <?php
                                                                                                                        $queryallsuper = "SELECT * FROM super WHERE sub_admin_id = '$sn'";
                                                                                                                        $resultllsuper = $con->query($queryallsuper);
                                                                                                                        $totalallsuper = mysqli_num_rows($resultllsuper);
                                                                                                                        echo $totalallsuper;
                                                                                                                        ?></h4>
                                                                                            </label>
                                                                                            <div class="col-md-4 col-sm-4">
                                                                                                <select id="selectSuper<?php echo $p_id . time() ?>" name="selectSuper" class="form-control">
                                                                                                    <option selected>Select Supper ID</option>
                                                                                                    <?php

                                                                                                    $resultsallsuper = $con->query($queryallsuper);
                                                                                                    while ($rowpanallsuper = $resultsallsuper->fetch_assoc()) {
                                                                                                        $allsuperusername = $rowpanallsuper['s_id'];
                                                                                                        $allsuperid = $rowpanallsuper['sn'];
                                                                                                        echo "<option value='$allsuperid'>" . $allsuperusername . "</option>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-4 col-sm-4">
                                                                                                <select id="selectUser<?php echo $p_id . time() ?>" name="selectUser" class="form-control">

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <script type="text/javascript" language="javascript">
                                                                                    $(document).ready(function() {
                                                                                        //load_data();
                                                                                        function load_data(is_category) {
                                                                                            var dataTable = $('#dataTable<?php echo $p_id . time() ?>').DataTable({
                                                                                                "processing": true,
                                                                                                "serverSide": true,
                                                                                                "order": [],
                                                                                                "ajax": {
                                                                                                    url: "allsellerfetch.php",
                                                                                                    type: "POST",
                                                                                                    data: {
                                                                                                        is_category: is_category
                                                                                                    }
                                                                                                },
                                                                                                "columnDefs": [{
                                                                                                    "targets": [2],
                                                                                                    "orderable": false,
                                                                                                }, ],
                                                                                            });
                                                                                        }

                                                                                        $(document).on('change', '#selectUser<?php echo $p_id . time() ?>', function() {
                                                                                            var category = $(this).val();
                                                                                            $('#dataTable<?php echo $p_id . time() ?>').DataTable().destroy();
                                                                                            if (category != 'Select Seller ID' || '') {
                                                                                                load_data(category);
                                                                                            } else {
                                                                                                load_data();
                                                                                            }
                                                                                        });
                                                                                    });
                                                                                </script>
                                                                                <div class="table-responsive">
                                                                                    <table id="dataTable<?php echo $p_id . time() ?>" class="table table-striped table-bordered table-sm display" cellspacing="0" width="100%">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>SELLER ID</th>
                                                                                                <th>KEY</th>
                                                                                                <th>Start Date</th>
                                                                                                <th>Left Days</th>
                                                                                                <th>Paid/Unpaid</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tfoot>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>SELLER ID</th>
                                                                                                <th>KEY</th>
                                                                                                <th>Start Date</th>
                                                                                                <th>Left Days</th>
                                                                                                <th>Paid/Unpaid</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            <script>
                                                                                $(document).ready(function() {
                                                                                    $('#dataTable<?php echo $p_id . time() ?>').DataTable();
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php echo $regitrationdate ?>
                                                            </td>
                                                            <td><a href="sub_chnge_password.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">CHANGE
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
                                                            <td><a href="sub_add_credit.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Add Credit</a>
                                                            </td>
                                                            <td><a href="sub_deduct.php?id=<?php echo $p_id ?>&sn=<?php echo $sn ?>">Delete Credit</a>
                                                            </td>
                                                            <td><a onclick="return chcekcreate();" href="<?php echo $delete ?>">Delete ID</a></td>

                                                            <?php
                                                            $queryresstatus = "SELECT * FROM sub_admin WHERE san = '$sn'";
                                                            $resultstatus = $con->query($queryresstatus);
                                                            $rowstatus = $resultstatus->fetch_assoc();
                                                            if ($rowstatus['paid_button'] == 0) {
                                                                $buttonurl = "subadmin_create.php?changepaidbuttonon=true & san=" . $sn;
                                                                $buttonname = "Active";
                                                            } else {
                                                                $buttonurl = "subadmin_create.php?changepaidbuttonoff=true & san=" . $sn;
                                                                $buttonname = "Deactive";
                                                            }
                                                            ?>
                                                            <td> <a href="<?php echo $buttonurl; ?>"><?php echo $buttonname; ?></a></td>
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
                                                    <th>REGISTRATION DATE</th>
                                                    <th>CHANGE PASSWORD</th>
                                                    <th>STATUS</th>
                                                    <th>TOTAL SUPER</th>
                                                    <th>Credit Left</th>
                                                    <th>Credit Add</th>
                                                    <th>Credit Deduct</th>
                                                    <th>ACTION</th>
                                                    <th>Paid Button</th>
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
<script>
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>
<script>
    function chcekcreate() {
        return confirm('Are You Want To Delete ?');
    }
</script>
<?php
include('footer.php');
?>