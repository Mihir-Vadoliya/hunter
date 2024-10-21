<?php 
include('admin_head.php'); 
?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <!-- Page Heading -->
        
        <p class="mb-4">	

         
      
      </p>
       



        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>PANEL NO.</th>
                     <th> SUPER</th>
                    <th>AGENT USER</th>
                    <th>PANEL ID</th>
                    <!-- <th>PASSWORD</th> -->
                    <!-- <th>CHANGE PASSWORD</th> -->
                    <th>STATUS</th>
                    <th>TOTAL KEYS</th>
                    <th>Credit Left</th>
                    <th>Add Credit</th>
                    <th>Dedcut Credit</th>
                    
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>PANEL NO.</th>
                    <th> SUPER</th>
                    <th>AGENT USER</th>
                    <th>PANEL ID</th>
                    <!-- <th>PASSWORD</th> -->
                    <!-- <th>CHANGE PASSWORD</th> -->
                    <th>STATUS</th>
                    <th>TOTAL KEYS</th>
                    <th>Credit Left</th>
                    <th>Add Credit</th>
                    <th>Dedcut Credit</th>
                
                  </tr>
                </tfoot>
                <tbody>
                <?php

//$m=$_SESSION['info']['s_id'];
//echo $m;
//echo "mad";
$sql = "SELECT * FROM userinfo";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i=1;
    while($row = $result->fetch_assoc()) {
      //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
        $sn= $row["sn"];
         $sid= $row["super_name"];
        $sn1= 'PANEL'.$i;
        $wallet=$row["user_wallet"];
        $i=$i+1;
        $p_id=$row["p_id"];
        $client_name=$row["name"];
        $pass=$row["password"];
        $activated=$row["status"];
        //diff time stamp giving same time
       $sql1="SELECT * FROM details where agent_user='$p_id'";
$rowcount=0;
if ($result1=mysqli_query($con,$sql1))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result1);
 
  // Free result set
  mysqli_free_result($result1);
  }

//super unpaid
$sql17 = "SELECT * FROM details where agent_user='$p_id' AND status=0";
 $result17= $con->query($sql17);
 $rowcount17=mysqli_num_rows($result17);
 //receive amount
$sql18 = "SELECT * FROM details where agent_user='$p_id' AND super_pay=0";
 $result18= $con->query($sql18);
 $rowcount18=mysqli_num_rows($result18);





     if ($activated == 0) {
        //$o='activated';
        $o='<center><img src="img/active.png"></center>';
        $ol='deactivate';
        $url='admin_super_deactivate.php?sn='.$sn.'&id='.$p_id ;
        ;
        } else {
         //$o='deactivated';
         $o='<center><img src="img/deactive.png"></center>';
         $ol='activate';
         $url='admin_super_activate.php?sn='.$sn.'&id='.$p_id;
      } 
/* if ($activated == 0) {
        $o='ACTIVATED';
        $ol='DEACTIVE';
        $url='super_deactivate.php?sn='.$sn.'&id='.$p_id ;
        ;
        } else {
         $o='DEACTIVATED';
         $ol='ACTIVATE';
         $url='super_activate.php?sn='.$sn.'&id='.$p_id;
      }
*/
?>

<tr><td><?php echo $sn1 ?></td><td><?php echo $sid ?></td><td><?php echo $client_name?></td><td > <?php echo $p_id ?></td><td><a href="<?php echo $url ?>"><?php echo $o ?></a></td><td><?php echo $rowcount ?></td><td><?php echo $row["user_credit"] ?></td><td><a href="admin_add_seller.php?id=<?php echo $p_id ?>&sn=<?php echo $wallet?>">Add Credit</a></td><td><a href="admin_deduct_seller.php?id=<?php echo $p_id ?>&sn=<?php echo $wallet?>">Delete Credit</a></td></tr>

<?php


    }

//agent_user, user_id, client_name, status, user_type,mac, registration, admin_msg, payment, expiry_date, activated

} else {
    echo "0 results";
}

?>
          

             
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
<?php 
include('footer.php'); 
?>

     