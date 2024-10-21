
<?php 
include('seller_head.php');
  include 'database/config.php';
  date_default_timezone_set("Asia/Kolkata");
  ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <main class="app-content">
   <div class="app-title">
      <div>
         <h1><i class="fa fa-th-list"></i>Keys</h1>
         <p>Seller Keys</p>
      </div>
      <?php if ($_GET['id']){ ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong><?php echo $_GET['id'] ?> </strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <?php } ?>
      <ul class="app-breadcrumb breadcrumb side">
         <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
         <li class="breadcrumb-item">Tables</li>
         <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
      </ul>
   </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="list-inline list-unstyled">
                <li class="list-inline-item">
                    <h4 class="m-0 font-weight-bold text-primary">
                <font size="+2">Today Result: 
                    <?php 
                         
                        $todaydate =  date('Y-m-d');
                        $querytores="SELECT * FROM `u952853138_Hunterits`.`tickets2`";
                        $resulttores=mysqli_query($con,$querytores);
                        $counttores=mysqli_num_rows($resulttores);
                        
                        if($counttores > 0){
                        $i=0;
                        while($rowpantores=mysqli_fetch_assoc($resulttores)){
                         
                        $regdate =  $rowpantores['Today'];
                        $registrationdate = date("Y-m-d", strtotime($regdate));
                        if($todaydate == $registrationdate){
                            $i++;
                            
                         }
                       
                        }
                         echo $i;
                        }
                        
                       
                       ?>
                
                
                </font>
            </h4>
                </li>
                <!--<li class="list-inline-item"><input type="button" id="btnExport" value="Export as PDF" onclick="generate();" /></li>-->
            </ul>
            
            
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
            <script type="text/javascript">
                function generate() {
                    var doc = new jsPDF('p', 'pt', 'letter','A4');
                    var htmlstring = '';
                    var tempVarToCheckPageHeight = 0;
                    var pageHeight = 0;
                    pageHeight = doc.internal.pageSize.height;
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector  
                        '#bypassme': function (element, renderer) {
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
                            },
                             10: {
                                cellWidth: 100,
                            },
                             11: {
                                cellWidth: 100,
                            },
                             12: {
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
        </div>

        <div class="card-body">
            <div class="table-responsive">
                 <table data-page-length='100' class="table table-hover table-bordered border-primary table-md" id="sampleTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Bank</th>
                            <th>Train No</th>
                            <th>Class</th>
                            <th>Quota</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Jdate</th>
                            <th>Print Time</th>
                            <th>Image</th>
                            <!--<th>Irctcid</th>-->
                            <th>Slot</th>
                            <th>Key</th>

                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Bank</th>
                            <th>Train No</th>
                            <th>Class</th>
                            <th>Quota</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Jdate</th>
                            <th>Print Time</th>
                            <th>Image</th>
                            <!--<th>Irctcid</th>-->
                            <th>Slot</th>
                            <th>Key</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                                
                                $todaydate =  date('Y-m-d');
                                
                                //echo $todaydate;
                                
                                // $querydate = "SELECT PNR_Time FROM `u952853138_Hunterits`.`tickets`";
                                // $resultsdate = $conn->prepare($querydate);
                                
                                $query = "SELECT * FROM `u952853138_Hunterits`.`tickets2` ORDER BY DATE(Today)='$todaydates' DESC ";
                                $results = $conn->prepare($query);
                                  
                                $results->execute();
                                $count = $results->rowCount();
                               if($count > 0){
                                    $i=1;
                                while($rowpan = $results->fetch(PDO::FETCH_ASSOC)){
                                  //print_r($rowpan);
                                 $todates = $rowpan['Today'];
                                 $todate =  date("Y-m-d", strtotime($todates));
                                 //$images = $rowpan['base64image'];
                                // $ralimg = 'image/jpeg;base64,'.base64_encode($images);
                                //echo $images ."</br>";
                                  if($todaydate == $todate){
                                    ?>
                               


                                <tr>
                                    <td><?php echo $i;  ?></td>
                                    <td> <?php echo $rowpan['Bank'];  ?></td>
                                    <td><?php echo $rowpan['Trainno']; ?></td>
                                    <td><?php echo $rowpan['Cls']; ?></td>
                                    <td><?php echo $rowpan['Quota'];?></td>
                                    <td><?php echo $rowpan['From']; ?></td>
                                    <td><?php echo $rowpan['To']; ?></td>
                                    <td><?php echo $rowpan['Jdate']; ?></td>
                                    <td><?php echo $rowpan['Pnrtime']; ?></td>
                                    <td><?php echo '<img width=150px height=auto src="data:image/jpeg;base64,'.base64_encode($rowpan['Img']).'" />'; ?></td>
                                    <td><?php echo $rowpan['Slot']; ?></td>
                                    <td><?php echo $rowpan['Key']; ?></td>
                                </tr>
                        <?php
                          $i++; 
                                  }
                                }
                               }
                               else{
                                     echo "There Is No Data Found!";
                                  }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</div>

<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php include 'footer.php'; ?>
