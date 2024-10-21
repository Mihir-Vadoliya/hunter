<?php 
include('seller_head.php'); 
?>
 <?PHP
        $me=$_SESSION['info']['p_id'];
        //$sql = "SELECT * FROM details where agent_user='$me'";
       
        ?>
       <!-- Begin Page Content -->
       <div class="container-fluid">
      
        <?PHP
        $me=$_SESSION['info']['p_id'];
        //$sql = "SELECT * FROM details where agent_user='$me'";
       
        ?>


<main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Data Table</h1>
                <p>Seller Transaction</p>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
            </ul>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    
                    <div class="tile-body">
                    <div class="table-responsive" >
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Destination</th>
                                <th>Train No</th>
                                <th>Gateway</th>
                                <th>PNR Time</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                             
                            <?php

//include('config.php'); 


// $name123=$_SESSION['info']['p_id'];

// $reg_date = date('Y-m-d h:i:sa');
// $todaydate =  date('Y-m-d');
// $sql = "SELECT * FROM tickets";
//echo $sql;

$name123=$_SESSION['info']['p_id'];
$UserID= $_GET['id'];
$reg_date = date('Y-m-d h:i:sa');
$todaydate =  date('Y-m-d');
$sql = "SELECT * FROM tickets where UserID='$UserID'";

$result = $con->query($sql);

if (!$result) {
    trigger_error('Invalid query: ' . $con->error);
}
$i=0;
//$sql = "SELECT * FROM details";
//$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
        $i=$i+1;

         $todate = $row['PNR_Time'];
                                 $todate =  date("Y-m-d", strtotime($todate));
                                 //$images = $rowpan['base64image'];
                                // $ralimg = 'image/jpeg;base64,'.base64_encode($images);
                                //echo $images ."</br>";
                                  if($todaydate == $todate){
                                      
//   

?>
          
          <tr>
                                    <td> <?php echo $row['Src_Dest'];  ?></td>
                                    <td><?php echo $row['TrainNo']; ?></td>
                                    <td><?php echo $row['Gateway']; ?></td>
                                    <td><?php echo $row['PNR_Time'];?></td>
                                    <td><img src = "data:image/png;base64,<?php echo ($row['base64image']); ?>" width = "150px" height = "150px"/></td>
                                    <td><?php echo $row['Status']; ?></td>
                                </tr>
                <?php

}
                    }


                    } else {
                    echo " ";
                    }


                ?>
                            </tbody>
                        </table>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


<?php 
include('footer.php'); 

?>
<script>
    $(document).ready(function() {
    $('#sampleTable').DataTable( {
        'destroy': true,
        "lengthMenu": [[10, 25, 50,1000,2000, -1], [10, 25, 50,1000,2000,"All"]]
    } );
} );
</script>

     