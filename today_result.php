<?php
include('seller_head.php');
include 'database/config.php';
include('config.php');
date_default_timezone_set("Asia/Kolkata");
if (isset($_SESSION['sellerid'])) {
    $admin_name = $_SESSION['sellerid'];
}
?>

<!-- Begin Page Content -->
<style>
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #fff;
        background-image: linear-gradient(180deg, #009688 10%, #009688 100%);
        border: none;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Seller Dashboard</h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Today Result Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row my-2">
                                <ul class="nav nav-tabs text-light" style="background:#222d32;" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active bg-transparent" id="allid-tab" data-toggle="tab" data-target="#allid" type="button" role="tab" aria-controls="allid" aria-selected="true"><strong class="text-light">
                                                <h4 class="m-0 font-weight-bold text-dark">
                                                    <font size="+2">Today Result:
                                                        <?php

                                                        $todaydate =  date('Y-m-d');
                                                        $querytores = "SELECT * FROM `u952853138_Hunterits`.`tickets` where UserID in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                        $resulttores = mysqli_query($con, $querytores);
                                                        $counttores = mysqli_num_rows($resulttores);

                                                        if ($counttores > 0) {
                                                            $i = 0;
                                                            while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                                                                $regdate =  $rowpantores['PNR_Time'];
                                                                $registrationdate = date("Y-m-d", strtotime($regdate));
                                                                if ($todaydate == $registrationdate) {
                                                                    $i++;
                                                                }
                                                            }
                                                            echo $i;
                                                        }


                                                        ?>


                                                    </font>
                                                </h4>
                                            </strong></button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link bg-transparent" id="activeid-tab" data-toggle="tab" data-target="#activeid" type="button" role="tab" aria-controls="activeid" aria-selected="false"><strong class="text-light">
                                                <h4 class="m-0 font-weight-bold text-dark">Total Result:
                                                    <?php echo $counttores; ?>
                                                </h4>
                                            </strong></button>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="allid" role="tabpanel" aria-labelledby="allid-tab">
                                            <div class="tile">
                                                <div class="tile-body">
                                                    <!-- DataTales Example -->
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                                            <h4 class="text-light"><strong>Today Result:
                                                                    <?php

                                                                    $todaydate =  date('Y-m-d');
                                                                    $querytores = "SELECT * FROM `u952853138_Hunterits`.`tickets` where UserID in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                    $resulttores = mysqli_query($con, $querytores);
                                                                    $counttores = mysqli_num_rows($resulttores);

                                                                    if ($counttores > 0) {
                                                                        $i = 0;
                                                                        while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                                                                            $regdate =  $rowpantores['PNR_Time'];
                                                                            $registrationdate = date("Y-m-d", strtotime($regdate));
                                                                            if ($todaydate == $registrationdate) {
                                                                                $i++;
                                                                            }
                                                                        }
                                                                        echo $i;
                                                                    }


                                                                    ?>
                                                                </strong></h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>SL</th>
                                                                            <th>User ID</th>
                                                                            <th>Src_Dst</th>
                                                                            <th>Train No</th>
                                                                            <th>Gateway</th>
                                                                            <th>Image</th>
                                                                            <th>PNR Time</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>SL</th>
                                                                            <th>User ID</th>
                                                                            <th>Src_Dst</th>
                                                                            <th>Train No</th>
                                                                            <th>Gateway</th>
                                                                            <th>Image</th>
                                                                            <th>PNR Time</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody>
                                                                        <?php

                                                                        $todaydate =  date('Y-m-d');

                                                                        $query = "SELECT * FROM `u952853138_Hunterits`.`tickets` where UserID in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                        $results = $con->query($query);
                                                                        if ($results->num_rows > 0) {
                                                                            $i = 1;
                                                                            while ($rowpan = $results->fetch_assoc()) {
                                                                                $todates = $rowpan['PNR_Time'];
                                                                                $todate =  date("Y-m-d", strtotime($todates));
                                                                                if ($todaydate == $todate) {
                                                                        ?>



                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php echo $i;  ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['UserID'];  ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['Src_Dest']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['TrainNo']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['Gateway']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo '<img width=180px height=105px src="data:image/gif;base64,' . $rowpan['base64image'] . '" />'; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['PNR_Time']; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php echo $rowpan['Status']; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                        <?php
                                                                                    $i++;
                                                                                }
                                                                            }
                                                                        } else {
                                                                            echo "There Is No Data Found!";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="activeid" role="tabpanel" aria-labelledby="activeid-tab">
                                            <div class="tile">
                                                <div class="tile-body">
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                                            <h4 class="text-light"><strong>Total Result: <?php echo $counttores; ?></strong></h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>SL</th>
                                                                            <th>User ID</th>
                                                                            <th>Src_Dst</th>
                                                                            <th>Train No</th>
                                                                            <th>Gateway</th>
                                                                            <th>Image</th>
                                                                            <th>PNR Time</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th>SL</th>
                                                                            <th>User ID</th>
                                                                            <th>Src_Dst</th>
                                                                            <th>Train No</th>
                                                                            <th>Gateway</th>
                                                                            <th>Image</th>
                                                                            <th>PNR Time</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </tfoot>
                                                                    <tbody>
                                                                        <?php

                                                                        $todaydate =  date('Y-m-d');
                                                                        $querytotaloutcomes = "SELECT * FROM `u952853138_Hunterits`.`tickets` where UserID in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                        $resultstotaloutcomes = $con->query($querytotaloutcomes);
                                                                        if ($resultstotaloutcomes->num_rows > 0) {
                                                                            $i = 1;
                                                                            while ($rowpantotaloutcomes = $resultstotaloutcomes->fetch_assoc()) {
                                                                                $todatestotaloutcomes = $rowpantotaloutcomes['PNR_Time'];
                                                                                $todatetotaloutcomes =  date("Y-m-d", strtotime($todatestotaloutcomes));

                                                                        ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <?php echo $i;  ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['UserID'];  ?>
                                                                                    </td>

                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['Src_Dest']; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['TrainNo']; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['Gateway']; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo '<img width=180px height=105px src="data:image/gif;base64,' . $rowpantotaloutcomes['base64image'] . '" />'; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['PNR_Time']; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $rowpantotaloutcomes['Status']; ?>
                                                                                    </td>
                                                                                </tr>
                                                                        <?php
                                                                                $i++;
                                                                            }
                                                                        } else {
                                                                            echo "There Is No Data Found!";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
                                    <script type="text/javascript">
                                        function generate() {
                                            var doc = new jsPDF('p', 'pt', 'letter', 'A4');
                                            var htmlstring = '';
                                            var tempVarToCheckPageHeight = 0;
                                            var pageHeight = 0;
                                            pageHeight = doc.internal.pageSize.height;
                                            specialElementHandlers = {
                                                // element with id of "bypass" - jQuery style selector  
                                                '#bypassme': function(element, renderer) {
                                                    // true = "handled elsewhere, bypass text extraction"  
                                                    return true
                                                }
                                            };
                                            margins = {
                                                top: 150,
                                                bottom: 60,
                                                left: 40,
                                                right: 40,
                                                width: 650
                                            };
                                            var y = 20;
                                            doc.setLineWidth(1);
                                            doc.text(100, y = y + 30, "Today Results");
                                            doc.autoTable({
                                                html: '#dataTable',
                                                startY: 70,
                                                theme: 'grid',
                                                columnStyles: {
                                                    0: {
                                                        cellWidth: 100,
                                                    },
                                                    1: {
                                                        cellWidth: 100,
                                                    },
                                                    2: {
                                                        cellWidth: 100,
                                                    },
                                                    3: {
                                                        cellWidth: 100,
                                                    },
                                                    4: {
                                                        cellWidth: 100,
                                                    },
                                                    5: {
                                                        cellWidth: 100,
                                                    },
                                                    6: {
                                                        cellWidth: 100,
                                                    },
                                                    7: {
                                                        cellWidth: 100,
                                                    },
                                                    8: {
                                                        cellWidth: 100,
                                                    },
                                                    9: {
                                                        cellWidth: 100,
                                                    }
                                                },
                                                styles: {
                                                    minCellHeight: 20
                                                }
                                            })
                                            doc.save('Today_Results.pdf');
                                        }
                                    </script>
                                    <script>
                                        // $(document).ready(function () {
                                        //     $('#dataTable').DataTable();
                                        // });


                                        $(document).ready(function() {
                                            $('table.display').DataTable();
                                        });
                                    </script>
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
    $(document).ready(function() {
        $('table.display').DataTable();
    });
</script>