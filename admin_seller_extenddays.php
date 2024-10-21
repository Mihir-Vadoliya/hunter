<?php 
include('admin_head.php'); 
include('database/config.php');
date_default_timezone_set("Asia/Kolkata");
$userpanid = $_GET['id'];
?>
<main class="app-content">
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>Keys</h1>
        <p>Seller Keys</p>
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
            <h3 class="tile-title">
              <?php
              if(isset($_SESSION['credit_empty'])){
                  echo $_SESSION['credit_empty'];
                  unset($_SESSION['credit_empty']);
              }
              ?>
            </h3>
            <div class="tile-body">
               <form action="admin_seller_extenddays.php" method="post">
                  <div class="row">
                      <div class="offset-lg-4 offset-md-4 col-sm-2 col-md-2 col-lg-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="form-label mt-4">Name</label>
                          <input type="number" class="form-control" name="enterdays" id="days" aria-describedby="days"
                            required placeholder="Enter Days">
                        </div>
                      </div>
                      <div style="display:none;" class="col-sm-2 col-md-2 col-lg-2 hidden">
                        <div class="form-group">
                          <label for="clientid" class="form-label mt-4">Client ID</label>
                          <input type="hidden" class="form-control" name="userid" id="clientid" value= "<?php echo $userpanid; ?>" aria-describedby="clientid"
                            required placeholder="CLIENT ID">
                        </div>
                      </div>      
                      <div class=" col-sm-2 col-md-2 col-lg-2">
                        <div class="form-group">
                          <label for="exampleInputEmail1" style="visibility:hidden;" class="form-label mt-4">Email address</label>
                          <input type="submit" class="btn btn-info form-control" name="extend_id" value="Extend ID" id="popUpYes">
                        </div>
                      </div>
                    </div>
                    </form>   
            </div>
        </div>
    </div>
</div>
</main>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $extenddate = $_POST['enterdays'];
    $id = $_POST['userid'];
    $todaydate = date('Y-m-d h:i:sa');
    $sql = "SELECT * FROM `u952853138_Hunterits`.`details` where `sn` ='$id'";
    $results = $conn->prepare($sql);
    $results->execute();
    $row = $results->fetch(PDO::FETCH_ASSOC);
    $count = $results->rowCount();
    if ($count > 0) {
          $expiredate = $row['expiry_date'];
          $timemodified1 = date('Y-m-d h:i:sa', strtotime($expiredate));
          $registrationdate = $row['registration'];
          $day_left = strtotime(date('Y-m-d h:i:sa'));
          $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);
          $extenddatess = ($days + $extenddate);
        $dateextends =date('Y-m-d h:i:sa',strtotime('+'.$extenddatess .'days'));
        $dateextend =date('Y-m-d h:i:sa', strtotime($dateextends));
        $sql = "UPDATE `u952853138_Hunterits`.`details` SET `expiry_date`='$dateextend'  WHERE `sn`='$id'";
        $CREDITRESULTS = $conn->query($sql);
        if ($conn->query($sql) == true){
            // header('location:admin_home.php?id=SUCCESSFULLY_Added_Super_User');
                   header('location:admin_id.php?id=success');
                    //session_destroy();
        } 
       
       
    }
}

include('footer.php'); 
?>

      