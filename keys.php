<?php
include('seller_head.php');
date_default_timezone_set("Asia/Kolkata");
include('config.php');
if (isset($_SESSION['sellerid'])) {
   $admin_name = $_SESSION['sellerid'];
   //echo $admin_name;
   $todaydate = date('Y-m-d h:i:sa');
   $queryres = "SELECT * FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name') ";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}
if (isset($_SESSION['pan_id'])) {
   $pan_id = $_SESSION['pan_id'];
}
$warningmsg ='';

if (isset($_SESSION['creditempty'])) {
   $warningmsg = $_SESSION['creditempty'];
   unset($_SESSION['creditempty']);
}elseif( $_SESSION['creditpaid']){
      $warningmsg =$_SESSION['creditpaid'];
     unset($_SESSION['creditpaid']);
}
?>

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
              <h1 class="m-0 text-dark">Seller Dashboard | <span>Gift Credit: 
            <?php                                 
               $masteradmincredit = "SELECT * FROM userinfo where sn='$admin_name'";
               $resultcreditmasteradmin = $con->query($masteradmincredit);
               while ($rowcreditasteradmin = $resultcreditmasteradmin->fetch_assoc()) {
            		$creditmasteradmin = $rowcreditasteradmin["user_credit"];
            	}
             echo $creditmasteradmin;
             ?>
            </span></h1>
               <div class="m-0 text-success"><?php echo $warningmsg ?></div>
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
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Info boxes -->

         <?PHP
         $queryactive = "SELECT * FROM userinfo where status = 0 and super_id in (SELECT sn FROM super where sub_admin_id in ( SELECT san FROM sub_admin WHERE mini_admin_id	 = '$admin_name'))";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM userinfo where status = 1 and super_id in (SELECT sn FROM super where sub_admin_id in ( SELECT san FROM sub_admin WHERE mini_admin_id	 = '$admin_name'))";
         $resultdeactive = $con->query($querydeactive);
         $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
         // $creditrow = $resultdeactive->fetch_assoc();
         // $totalcredit = $creditrow['payment'];             

         ?>

         <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">All ID Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                     <div class="row my-2">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                           <form class="row" action="id_add.php" method="post">
                              <div class="form-group col-md-3">
                                 <label class="control-label">CLIENT NAME</label>
                                 <input type="text" class="form-control" name="userName" id="exampleInputEmail1" aria-describedby="NameHelp" required placeholder="CLIENT NAME">
                                 <small id="NameHelp" class="form-text text-muted">We'll never share your Info with anyone else.</small>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="control-label">CLIENT ID</label>
                                 <input type="text" class="form-control" name="userid" id="exampleInputEmail1" aria-describedby="IDHelp" required placeholder="CLIENT ID">
                                 <small id="IDHelp" class="form-text text-muted">We'll never share your Info with anyone else.</small>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="control-label">Select From Bellow</label>
                                 <select class="form-control" name="UserType" id="UserType">
                                    <option value="1">Full Version</option>
                                    <?php
                                    $sql = "SELECT * FROM demoswitch ";
                                    $result = $con->query($sql);
                                    $row = $result->fetch_assoc();
                                    $value = $row['status'];

                                    if ($value == 'Active') {
                                       echo '<option value="2">Demo</option>';
                                    }
                                    ?>
                                 </select>
                              </div>
                              <div class="form-group col-md-3">
                                 <label for="exampleInputEmail1" style="visibility:hidden;" class="form-label">Email address</label>
                                 <input class="btn btn-primary form-control" type="submit" value="ADD NEW ID">
                              </div>
                           </form>

                           <!-- Page Heading -->
                           <?PHP
                           $queryactive = "SELECT * FROM details where activated=0 AND agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                           $resultactive = $con->query($queryactive);
                           $totalactivesubadmin = mysqli_num_rows($resultactive);

                           $querydeactive = "SELECT * FROM details where activated=1  AND agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                           $resultdeactive = $con->query($querydeactive);
                           $totaldeactivesubadmin = mysqli_num_rows($resultdeactive);
                           // $creditrow = $resultdeactive->fetch_assoc();
                           // $totalcredit = $creditrow['payment'];

                           ?>

                           <ul class="nav nav-tabs" id="myTab" style="background:#222d32;" role="tablist">
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link active bg-transparent" id="allid-tab" data-toggle="tab" data-target="#allid" type="button" role="tab" aria-controls="allid" aria-selected="true"><strong class="text-light">Total ID: <?php echo $totalsubadmin; ?></strong></button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="activeid-tab" data-toggle="tab" data-target="#activeid" type="button" role="tab" aria-controls="activeid" aria-selected="false"><strong class="text-light">Activate ID: <?php echo $totalactivesubadmin; ?></strong></button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="deactivid-tab" data-toggle="tab" data-target="#deactivid" type="button" role="tab" aria-controls="deactivid" aria-selected="false"><strong class="text-light">Deactivate ID: <?php echo $totaldeactivesubadmin; ?></strong></button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="todayid-tab" data-toggle="tab" data-target="#todayid" type="button" role="tab" aria-controls="todayid" aria-selected="false">
                                    <strong class="text-light"> Today Create ID:
                                       <?php
                                       include('database/config.php');
                                       $todaydate =  date('Y-m-d');
                                       $querytores = "SELECT * FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                       $resulttores = mysqli_query($con, $querytores);
                                       $counttores = mysqli_num_rows($resulttores);

                                       if ($counttores > 0) {
                                          $i = 0;
                                          while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                                             $regdate =  $rowpantores['registration'];
                                             $registrationdate = date("Y-m-d", strtotime($regdate));
                                             if ($todaydate == $registrationdate) {
                                                $i++;
                                             }
                                          }
                                          echo $i;
                                       }


                                       ?></strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="paidid-tab" data-toggle="tab" data-target="#paidid" type="button" role="tab" aria-controls="paidid" aria-selected="false">
                                    <strong class="text-light">Paid ID:
                                       <?php
                                       $querypaid = "SELECT * FROM details where admin_pay = 1 and agent_user in (Select p_id from userinfo where sn  = '$admin_name') ";
                                       $resultpaid = $con->query($querypaid);
                                       $totalpaidid = mysqli_num_rows($resultpaid);
                                       echo $totalpaidid;
                                       ?></strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="unpaidid-tab" data-toggle="tab" data-target="#unpaidid" type="button" role="tab" aria-controls="unpaidid" aria-selected="false">
                                    <strong class="text-light">Unpaid ID:
                                       <?php
                                       $queryunpaid = "SELECT * FROM details where admin_pay = 0 and agent_user in (Select p_id from userinfo where sn  = '$admin_name') ";
                                       $resultunpaid = $con->query($queryunpaid);
                                       $totalunpaidid = mysqli_num_rows($resultunpaid);
                                       echo $totalunpaidid;
                                       ?> </strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="expiredid-tab" data-toggle="tab" data-target="#expiredid" type="button" role="tab" aria-controls="expiredid" aria-selected="false">
                                    <strong class="text-light"> Expired ID:
                                       <?php
                                       include('database/config.php');
                                       $monthid = date('m');
                                       $querytomonth = "SELECT * FROM details where DATE(expiry_date) < '$todaydate' and agent_user in (Select p_id from userinfo where sn  = '$admin_name') ";
                                       $resulttomonth = mysqli_query($con, $querytomonth);
                                       $counttomonth = mysqli_num_rows($resulttomonth);
                                       echo $counttomonth;
                                       //  if($counttomonth > 0){
                                       //  $imonth=0;
                                       //  while($rowpantomonth=mysqli_fetch_assoc($resulttomonth)){

                                       //  $regdatemonth =  $rowpantomonth['registration'];
                                       //  $registrationdatemonth = date("m", strtotime($regdatemonth));
                                       //  if($monthid == $registrationdatemonth){
                                       //     $imonth++;

                                       //  }

                                       //  }
                                       //  echo $imonth;
                                       //  }


                                       ?>
                                    </strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent disabled text-light" id="expiredid-tab" data-toggle="tab" data-target="#expiredid" type="button" role="tab" aria-controls="expiredid" aria-selected="false">
                                    <strong class="text-light"> Gift Credit:
                                       <?php
                                       $credit = 0;
                                       $sql17 = "SELECT * FROM userinfo where p_id='" . $_SESSION['info']['p_id'] . "'";
                                       $result17 = $con->query($sql17);
                                       while ($row = $result17->fetch_assoc()) {
                                          $credit = $row["user_credit"];
                                          $p_id = $row["p_id"];
                                       }
                                       echo $credit;
                                       ?> </strong></button>
                              </li>
                           </ul>
                        </div>
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
                                             <h4 class="text-light"><strong>All ID: <?php echo $totalsubadmin; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqlallidsell = "SELECT * FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultallidsell = $con->query($sqlallidsell);
                                                      if ($resultallidsell->num_rows > 0) {
                                                         while ($rowsellidall = $resultallidsell->fetch_assoc()) {
                                                            if ($rowsellidall['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsellidall['sn'] . '&id=' . $rowsellidall['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsellidall['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsellidall['sn'] . '&id=' . $rowsellidall['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsellidall['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsellidall['sn'] . '&id=' . $rowsellidall['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusforallid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `admin_pay`='1', `admin_pay_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          $_SESSION['creditpaid'] = "<h4 style='color:green';>Your ID is Paid Successfully...........!</h4>";
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsellidall['user_id'] ?></td>
                                                               <td><?php echo $rowsellidall['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsellidall['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsellidall['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsellidall['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsellidall['admin_pay'] ==0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsellidall['admin_pay'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusforallid=true&id=<?php echo $rowsellidall['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="activeid" role="tabpanel" aria-labelledby="activeid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php echo $totalactivesubadmin; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqlactiveallid = "SELECT * FROM details where activated=0 and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultactiveallid = $con->query($sqlactiveallid);
                                                      if ($resultactiveallid->num_rows > 0) {
                                                         while ($rowsactiveallid = $resultactiveallid->fetch_assoc()) {
                                                            if ($rowsactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsactiveallid['sn'] . '&id=' . $rowsactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsactiveallid['sn'] . '&id=' . $rowsactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsactiveallid['sn'] . '&id=' . $rowsactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusforactiveid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">No</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusforactiveid=true&id=<?php echo $rowsactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="deactivid" role="tabpanel" aria-labelledby="deactivid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php echo $totaldeactivesubadmin; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqldeactiveallid = "SELECT * FROM details where activated=1 and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultdeactiveallid = $con->query($sqldeactiveallid);
                                                      if ($resultdeactiveallid->num_rows > 0) {
                                                         while ($rowsdeactiveallid = $resultdeactiveallid->fetch_assoc()) {
                                                            if ($rowsdeactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsdeactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsdeactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusfordeactivid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsdeactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsdeactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsdeactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusfordeactivid=true&id=<?php echo $rowsdeactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>

                              <div class="tab-pane fade" id="todayid" role="tabpanel" aria-labelledby="todayid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php
                                                                                    include('database/config.php');
                                                                                    $todaydate =  date('Y-m-d');
                                                                                    $querytores = "SELECT * FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                                                    $resulttores = mysqli_query($con, $querytores);
                                                                                    $counttores = mysqli_num_rows($resulttores);

                                                                                    if ($counttores > 0) {
                                                                                       $i = 0;
                                                                                       while ($rowpantores = mysqli_fetch_assoc($resulttores)) {

                                                                                          $regdate =  $rowpantores['registration'];
                                                                                          $registrationdate = date("Y-m-d", strtotime($regdate));
                                                                                          if ($todaydate == $registrationdate) {
                                                                                             $i++;
                                                                                          }
                                                                                       }
                                                                                       echo $i;
                                                                                    }


                                                                                    ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqldeactiveallid = "SELECT * FROM details where DATE(registration) = '$todaydate' and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultdeactiveallid = $con->query($sqldeactiveallid);
                                                      if ($resultdeactiveallid->num_rows > 0) {
                                                         while ($rowsdeactiveallid = $resultdeactiveallid->fetch_assoc()) {
                                                            if ($rowsdeactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsdeactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsdeactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusfortodayid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsdeactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsdeactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsdeactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusfortodayid=true&id=<?php echo $rowsdeactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="paidid" role="tabpanel" aria-labelledby="paidid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php echo $totalpaidid; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqldeactiveallid = "SELECT * FROM details where  admin_pay = 1 and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultdeactiveallid = $con->query($sqldeactiveallid);
                                                      if ($resultdeactiveallid->num_rows > 0) {
                                                         while ($rowsdeactiveallid = $resultdeactiveallid->fetch_assoc()) {
                                                            if ($rowsdeactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsdeactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsdeactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusforpaidid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsdeactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsdeactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsdeactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusforpaidid=true&id=<?php echo $rowsdeactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="unpaidid" role="tabpanel" aria-labelledby="unpaidid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php echo $totalunpaidid; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqldeactiveallid = "SELECT * FROM details where  admin_pay = 0 and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultdeactiveallid = $con->query($sqldeactiveallid);
                                                      if ($resultdeactiveallid->num_rows > 0) {
                                                         while ($rowsdeactiveallid = $resultdeactiveallid->fetch_assoc()) {
                                                            if ($rowsdeactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsdeactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsdeactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusforunpaidid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsdeactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsdeactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsdeactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusforunpaidid=true&id=<?php echo $rowsdeactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="expiredid" role="tabpanel" aria-labelledby="expiredid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>All ID: <?php echo $counttomonth; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No</th>
                                                         <th>Key</th>
                                                         <th>Customer Name</th>
                                                         <th>MAC</th>
                                                         <th>Reg.Date</th>
                                                         <th>Exp.Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>IP</th>
                                                         <th>Renew</th>
                                                         <th>Paid ID</th>
                                                         <th>Seller Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $srl = 0;
                                                      $sqldeactiveallid = "SELECT * FROM details where  DATE(expiry_date) < '$todaydate' and agent_user in (Select p_id from userinfo where sn  = '$admin_name')";
                                                      $resultdeactiveallid = $con->query($sqldeactiveallid);
                                                      if ($resultdeactiveallid->num_rows > 0) {
                                                         while ($rowsdeactiveallid = $resultdeactiveallid->fetch_assoc()) {
                                                            if ($rowsdeactiveallid['mac'] === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'reset_id.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            }

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($rowsdeactiveallid['expiry_date']) - $day_left) / 60 / 60 / 24);

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }

                                                            if ($rowsdeactiveallid['user_type'] == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL';
                                                            }

                                                            if ($days <= 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'renew.php?sn=' . $rowsdeactiveallid['sn'] . '&id=' . $rowsdeactiveallid['user_id'];
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                            }
                                                            $srl++;

                                                            if (isset($_GET['changepaymentstatusforexpiredid'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                            //   $sellercredit = "Select * from `userinfo` where `sn` ='$admin_name' ";
                                                            //       $sellresultcredit = $con->query($sellercredit);
                                                            //       while ($sellrowcredit = $sellresultcredit->fetch_assoc()) {
                                                            //             $sellcredit = $sellrowcredit['user_credit'];
                                                            //         }
                                                                    if($credit > 0){
                                                                          $newsellcredit =  $credit - 1; 
                                                                          $sellpaymentcredit = "UPDATE `userinfo` SET `user_credit`='$newsellcredit' WHERE `sn`='$admin_name'";
                                                                          $sellercreditresult = mysqli_query($con, $sellpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `payment`='1', `payment_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          header("Location:keys.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                      ?>
                                                            <tr>
                                                               <td><?php echo $srl; ?></td>
                                                               <td><?php echo $rowsdeactiveallid['user_id'] ?></td>
                                                               <td><?php echo $rowsdeactiveallid['client_name'] ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['registration'])) ?></td>
                                                               <td><?php echo  date('d-m-Y', strtotime($rowsdeactiveallid['expiry_date'])) ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  $querytotalip = "SELECT * FROM detailsip where detusr_key in (SELECT user_id FROM details where agent_user in (Select p_id from userinfo where sn  = '$admin_name'))";
                                                                  $resulttotalip = mysqli_query($con, $querytotalip);
                                                                  //print_r($resulttotalip);
                                                                  $counttotalip = mysqli_num_rows($resulttotalip);

                                                                  if ($counttotalip > 0) {
                                                                     $totalip = 0;
                                                                     while ($rowpantotalip = mysqli_fetch_assoc($resulttotalip)) {
                                                                        $ipuserkey =  $rowpantotalip['detusr_key'];
                                                                        if ($rowsdeactiveallid['user_id'] == $ipuserkey) {
                                                                           $totalip++;
                                                                        }
                                                                     }
                                                                     echo $totalip;
                                                                  }


                                                                  ?>

                                                               </td>
                                                               <td><a href="<?php echo $renew ?>">RenewID</a></td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['admin_pay'] == 0) {
                                                                  ?>
                                                                     <p class="text-danger">NO</p>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>YES</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <td>
                                                                  <?php
                                                                  if ($rowsdeactiveallid['payment'] == 0) {
                                                                  ?>
                                                                     <a href="keys.php?changepaymentstatusforexpiredid=true&id=<?php echo $rowsdeactiveallid['sn']; ?>" class="text-danger pl-4 pr-3">Unpaid</a>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                     <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                               </td>

                                                            </tr>
                                                      <?php
                                                         }
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
                                 </div>
                              </div>
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