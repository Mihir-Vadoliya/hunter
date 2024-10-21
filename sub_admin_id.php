<?php
include('config.php');
include('sub_admin_head.php');
date_default_timezone_set("Asia/Kolkata");
if (isset($_SESSION['subid'])) {
   $admin_name = $_SESSION['subid'];
   $todaydate = date('Y-m-d h:i:sa');
   //$sql1 = "select sn from super where sub_admin_id='$admin_name' ";

   //$sql2 = "select sn from userinfo where super_id='$admin_name' ";

   $queryres = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name')) ";
   $result = $con->query($queryres);
   $totalsubadmin = mysqli_num_rows($result);
}
if (isset($_SESSION['info'])) {
   $paidstatus =  $_SESSION['info']['paid_button'];
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
               <h1 class="m-0 text-dark">Admin Dashboard | <span>Credit: 
                <?php                                 
                   $masteradmincredit = "SELECT * FROM sub_admin where san  = '$subadmin_name'";
                   $resultcreditmasteradmin = $con->query($masteradmincredit);
                   while ($rowcreditasteradmin = $resultcreditmasteradmin->fetch_assoc()) {
                		$creditmasteradmin = $rowcreditasteradmin["payment"];
                	}
                 echo $creditmasteradmin;
                 ?>
                </span></h1>
                <div class="m-0 text-success"><?php echo $warningmsg ?></div>
            </div><!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="subadmin_dashboard.php">Home</a></li>
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
         $queryactive = "SELECT * FROM details where activated = 0 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
         $resultactive = $con->query($queryactive);
         $totalactivesubadmin = mysqli_num_rows($resultactive);

         $querydeactive = "SELECT * FROM details where activated = 1 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
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
                           <ul class="nav nav-tabs" style="background:#222d32;" id="myTab" role="tablist">
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
                                       $querytores = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
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
                                    <strong class="text-light"> Paid ID:
                                       <?php
                                       $querypaid = "SELECT * FROM details where admin_pay = 1 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                       $resultpaid = $con->query($querypaid);
                                       $totalpaidid = mysqli_num_rows($resultpaid);
                                       echo $totalpaidid;
                                       ?></strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="unpaidid-tab" data-toggle="tab" data-target="#unpaidid" type="button" role="tab" aria-controls="unpaidid" aria-selected="false">
                                    <strong class="text-light"> Unpaid ID:
                                       <?php
                                       $queryunpaid = "SELECT * FROM details where admin_pay = 0 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                       $resultunpaid = $con->query($queryunpaid);
                                       $totalunpaidid = mysqli_num_rows($resultunpaid);
                                       echo $totalunpaidid;
                                       ?> </strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="monthid-tab" data-toggle="tab" data-target="#monthid" type="button" role="tab" aria-controls="monthid" aria-selected="false">
                                    <strong class="text-light"> This Month ID:
                                       <?php
                                       include('database/config.php');
                                       $monthid = date('m');
                                       $querytomonth = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                       $resulttomonth = mysqli_query($con, $querytomonth);
                                       $counttomonth = mysqli_num_rows($resulttomonth);

                                       if ($counttomonth > 0) {
                                          $imonth = 0;
                                          while ($rowpantomonth = mysqli_fetch_assoc($resulttomonth)) {

                                             $regdatemonth =  $rowpantomonth['registration'];
                                             $registrationdatemonth = date("m", strtotime($regdatemonth));
                                             if ($monthid == $registrationdatemonth) {
                                                $imonth++;
                                             }
                                          }
                                          echo $imonth;
                                       }


                                       ?>
                                    </strong>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link bg-transparent" id="expiredid-tab" data-toggle="tab" data-target="#expiredid" type="button" role="tab" aria-controls="expiredid" aria-selected="false">
                                    <strong class="text-light"> Expired ID:
                                       <?php
                                       include('database/config.php');
                                       $monthid = date('m');
                                       $querytomonth = "SELECT * FROM details where DATE(expiry_date) < '$todaydate' and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
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
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER ID</th>
                                                         <th>MAC</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>Admin Paid</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER ID</th>
                                                         <th>MAC</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                         <th>Admin Paid</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sql = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name')) ";
                                                      $result = $con->query($sql);

                                                      if ($result->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;
                                                         // output data of each row
                                                         while ($row = $result->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $row["sn"];
                                                            $user_id = $row["user_id"];
                                                            $agent_user = $row["agent_user"];
                                                            $client_name = $row["client_name"];
                                                            $days = 1;
                                                            $status = $row["status"];
                                                            $user_type = $row["user_type"];
                                                            $mac = $row["mac"];
                                                            $registration = $row["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registration));
                                                            $admin_msg = $row["admin_msg"];
                                                            $payment = $row["payment"];
                                                            $super_payment = $row["super_pay"];
                                                            $admin_payment = $row["admin_pay"];
                                                            $expiry_date = $row["expiry_date"];
                                                            $activated = $row["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($activated == 0) {
                                                               $o = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $url = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $o = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $url = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'mini_masterreset_mac.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                            if ($con->connect_error) {
                                                               die("Connection failed: " . $con->connect_error);
                                                            }



                                                            if (isset($_GET['changepaymentstatus'])) {
                                                               $seller_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                               $subadmincredit = "Select * from `sub_admin` where `san` ='$admin_name' ";
                                                                   $resultcreditsubadmin = $con->query($subadmincredit);
                                                                   while ($rowcreditsubadmin = $resultcreditsubadmin->fetch_assoc()) {
                                                                        $creditsubadmin = $rowcreditsubadmin["payment"];
                                                                    }
                                                                    if($creditsubadmin > 0){
                                                                         $newcreditsubadmin =  $creditsubadmin -1; 
                                                                          $superpaymentcredit = "UPDATE `sub_admin` SET `payment`='$newcreditsubadmin' WHERE `san`='$admin_name'";
                                                                          $creditresultsubadmin = mysqli_query($con, $superpaymentcredit);
                                                                          $paymentstm = "UPDATE `details` SET `admin_pay`='1', `admin_pay_date` = '$todate' WHERE `sn`='$seller_id'";
                                                                          $result = mysqli_query($con, $paymentstm);
                                                                          $_SESSION['creditpaid'] = "<h4 style='color:green';>Your ID is Paid Successfully...........!</h4>";
                                                                          header("Location:sub_admin_id.php");
                                                                    }else{
                                                                      $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
                                                                    }
                                                            }
                                                            if (isset($_GET['changepaymentstatussuper'])) {
                                                               $super_id = $_GET['id'];
                                                               $todate = date('Y-m-d h:i:sa');
                                                               $paymentstm = "UPDATE `details` SET `super_pay`='1', `super_pay_date` = '$todate' WHERE `sn`='$super_id'";
                                                               $result = mysqli_query($con, $paymentstm);
                                                               header("Location:sub_admin_id.php");
                                                            }


                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                               <td>
                                                                  <?php
                                                                  if ($paidstatus == 0) {
                                                                     if ($admin_payment == 0) {
                                                                  ?>
                                                                        <a href="sub_admin_id.php?changepaymentstatus=true&id=<?php echo $sn  ?>" class="text-danger">Unpaid</a>
                                                                     <?php
                                                                     } else {
                                                                     ?>
                                                                        <p class="text-success"><strong>Paid</strong></p>
                                                                     <?php
                                                                     }
                                                                  } else {

                                                                     if ($admin_payment == 0) {
                                                                     ?>
                                                                        <p class="text-danger">Unpaid</p>
                                                                     <?php
                                                                     } else {
                                                                     ?>
                                                                        <p class=" text-success"><strong>Paid</strong></p>
                                                                  <?php
                                                                     }
                                                                  }
                                                                  ?>
                                                               </td>
                                                               <!-- <td <?php echo $npay ?> ><?php echo $nspay ?></td>
                                       <td <?php echo $nsuper ?> ><?php echo $nssuper ?></td>
                                       <td <?php echo $nadmin ?> ><?php echo $nsadmin ?></td> -->
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                             <h4 class="text-light"><strong>Activate ID: <?php echo $totalactivesubadmin; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      $name = $_SESSION['info']['username'];
                                                      $sqlactive = "SELECT * FROM details where activated = 0 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name')) ";
                                                      $resultactive = $con->query($sqlactive);
                                                      if ($resultactive->num_rows > 0) {
                                                         $iactive = 0;
                                                         $srlactive = 0;
                                                         while ($rowactive = $resultactive->fetch_assoc()) {

                                                            $iactive = $iactive + 1;
                                                            $snactive = $rowactive["sn"];
                                                            $user_idactive = $rowactive["user_id"];
                                                            $agent_useractive = $rowactive["agent_user"];
                                                            $client_name = $rowactive["client_name"];
                                                            $days = 1;
                                                            $status = $rowactive["status"];
                                                            $user_type = $rowactive["user_type"];
                                                            $mac = $rowactive["mac"];
                                                            $registration = $rowactive["registration"];

                                                            $timemodified = date('d-m-Y', strtotime($registration));
                                                            $admin_msg = $rowactive["admin_msg"];
                                                            $payment = $rowactive["payment"];
                                                            $super_payment = $rowactive["super_pay"];
                                                            $admin_payment = $rowactive["admin_pay"];
                                                            $expiry_date = $rowactive["expiry_date"];
                                                            $activated = $rowactive["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                            $srlactive++;
                                                            $snactive = "";
                                                            $sqlactiveidf = "SELECT super_name FROM userinfo where p_id='$agent_useractive' ";
                                                            $resultactiveiff = $con->query($sqlactiveidf);


                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);


                                                            if ($resultactiveiff->num_rows > 0) {
                                                               $iidf = 1;
                                                               while ($rowactivefid = $resultactiveiff->fetch_assoc()) {
                                                                  $spnactive = $rowactivefid["super_name"];
                                                               }
                                                            }
                                                            if ($deactivated == 0) {
                                                               $oac = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $activateurl = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $oac = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $activateurl = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }

                                                      ?>
                                                            <tr>
                                                               <td> <?php echo $srlactive; ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_idactive; ?> </td>
                                                               <td><?php echo $spnactive ?></td>
                                                               <td><?php echo $agent_useractive ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light"><strong>Deactivate ID: <?php echo $totaldeactivesubadmin; ?></strong></h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sqldeactive = "SELECT * FROM details where activated = 1 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                      $resultdeactive = $con->query($sqldeactive);

                                                      if ($resultdeactive->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;

                                                         while ($rowdeactive = $resultdeactive->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $rowdeactive["sn"];
                                                            $user_id = $rowdeactive["user_id"];
                                                            $agent_user = $rowdeactive["agent_user"];
                                                            $client_name = $rowdeactive["client_name"];
                                                            $days = 1;
                                                            $status = $rowdeactive["status"];
                                                            $user_type = $rowdeactive["user_type"];
                                                            $mac = $rowdeactive["mac"];
                                                            $registration = $rowdeactive["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registration));
                                                            $admin_msg = $rowdeactive["admin_msg"];
                                                            $payment = $rowdeactive["payment"];
                                                            $super_payment = $rowdeactive["super_pay"];
                                                            $admin_payment = $rowdeactive["admin_pay"];
                                                            $expiry_date = $rowdeactive["expiry_date"];
                                                            $deactivated = $rowdeactive["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($deactivated == 0) {
                                                               $ode = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $deactivateurl = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $ode = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $deactivateurl = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'master_resetmac_id.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                             <h4 class="text-light">
                                                <strong> Today Create ID:
                                                   <?php
                                                   include('database/config.php');
                                                   $todaydate =  date('Y-m-d');
                                                   $querytores = "SELECT * FROM details where DATE(registration) = '$todaydate' and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                   $resulttores = mysqli_query($con, $querytores);
                                                   $counttores = mysqli_num_rows($resulttores);

                                                   //   if($counttores > 0){
                                                   //   $i=0;
                                                   //   while($rowpantores=mysqli_fetch_assoc($resulttores)){

                                                   //   $regdate =  $rowpantores['registration'];
                                                   //   $registrationdate = date("Y-m-d", strtotime($regdate));
                                                   //   if($todaydate == $registrationdate){
                                                   //       $i++;

                                                   //   }

                                                   //   }
                                                   //   echo $i;
                                                   //   }
                                                   echo $counttores;

                                                   ?></strong>
                                             </h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sqltodayid = "SELECT * FROM details where DATE(registration) = '$todaydate' and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                      $resulttodayid = $con->query($sqltodayid);

                                                      if ($resulttodayid->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;
                                                         // output data of each row
                                                         while ($rowtodayid = $resulttodayid->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $rowtodayid["sn"];
                                                            $user_id = $rowtodayid["user_id"];
                                                            $agent_user = $rowtodayid["agent_user"];
                                                            $client_name = $rowtodayid["client_name"];
                                                            $days = 1;
                                                            $status = $rowtodayid["status"];
                                                            $user_type = $rowtodayid["user_type"];
                                                            $mac = $rowtodayid["mac"];
                                                            $registrationtodayid = $rowtodayid["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registrationtodayid));
                                                            $admin_msg = $rowtodayid["admin_msg"];
                                                            $payment = $rowtodayid["payment"];
                                                            $super_payment = $rowtodayid["super_pay"];
                                                            $admin_payment = $rowtodayid["admin_pay"];
                                                            $expiry_date = $rowtodayid["expiry_date"];
                                                            $activated = $rowtodayid["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registrationtodayid));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($activated == 0) {
                                                               $o = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $url = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $o = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $url = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'master_resetmac_id.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                            if ($con->connect_error) {
                                                               die("Connection failed: " . $con->connect_error);
                                                            }



                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                             <h4 class="text-light">
                                                <strong> Paid ID:
                                                   <?php
                                                   $querypaid = "SELECT * FROM details where admin_pay = 1 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                   $resultpaid = $con->query($querypaid);
                                                   $totalpaidid = mysqli_num_rows($resultpaid);
                                                   echo $totalpaidid;
                                                   ?></strong>
                                             </h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sqlpaidid = "SELECT * FROM details where admin_pay = 1 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                      $resultpaidid = $con->query($sqlpaidid);

                                                      if ($resultpaidid->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;
                                                         // output data of each row
                                                         while ($rowpaidid = $resultpaidid->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $rowpaidid["sn"];
                                                            $user_id = $rowpaidid["user_id"];
                                                            $agent_user = $rowpaidid["agent_user"];
                                                            $client_name = $rowpaidid["client_name"];
                                                            $days = 1;
                                                            $status = $rowpaidid["status"];
                                                            $user_type = $rowpaidid["user_type"];
                                                            $mac = $rowpaidid["mac"];
                                                            $registration = $rowpaidid["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registration));
                                                            $admin_msg = $rowpaidid["admin_msg"];
                                                            $payment = $rowpaidid["payment"];
                                                            $super_payment = $rowpaidid["super_pay"];
                                                            $admin_payment = $rowpaidid["admin_pay"];
                                                            $expiry_date = $rowpaidid["expiry_date"];
                                                            $activated = $rowpaidid["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($activated == 0) {
                                                               $o = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $url = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $o = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $url = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'master_resetmac_id.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                            if ($con->connect_error) {
                                                               die("Connection failed: " . $con->connect_error);
                                                            }


                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                             <h4 class="text-light">
                                                <strong> Unpaid ID:
                                                   <?php
                                                   $queryunpaid = "SELECT * FROM details where admin_pay = 0 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                   $resultunpaid = $con->query($queryunpaid);
                                                   $totalunpaidid = mysqli_num_rows($resultunpaid);
                                                   echo $totalunpaidid;
                                                   ?> </strong>
                                             </h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sql = "SELECT * FROM details where admin_pay = 0 and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                      $result = $con->query($sql);

                                                      if ($result->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;
                                                         // output data of each row
                                                         while ($row = $result->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $row["sn"];
                                                            $user_id = $row["user_id"];
                                                            $agent_user = $row["agent_user"];
                                                            $client_name = $row["client_name"];
                                                            $days = 1;
                                                            $status = $row["status"];
                                                            $user_type = $row["user_type"];
                                                            $mac = $row["mac"];
                                                            $registration = $row["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registration));
                                                            $admin_msg = $row["admin_msg"];
                                                            $payment = $row["payment"];
                                                            $super_payment = $row["super_pay"];
                                                            $admin_payment = $row["admin_pay"];
                                                            $expiry_date = $row["expiry_date"];
                                                            $activated = $row["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($activated == 0) {
                                                               $o = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $url = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $o = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $url = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'master_resetmac_id.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                            if ($con->connect_error) {
                                                               die("Connection failed: " . $con->connect_error);
                                                            }

                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
                                                   </tbody>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="monthid" role="tabpanel" aria-labelledby="monthid-tab">
                                 <div class="tile">
                                    <div class="tile-body">
                                       <!-- DataTales Example -->
                                       <div class="card shadow mb-4">
                                          <div class="card-header py-1" style="background-image:linear-gradient(180deg,#009688 10%,#009688 100%)">
                                             <h4 class="text-light">
                                                <strong> This Month ID:
                                                   <?php
                                                   include('database/config.php');
                                                   $monthid = date('m');
                                                   $querytomonth = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                   $resulttomonth = mysqli_query($con, $querytomonth);
                                                   $counttomonth = mysqli_num_rows($resulttomonth);

                                                   if ($counttomonth > 0) {
                                                      $imonth = 0;
                                                      while ($rowpantomonth = mysqli_fetch_assoc($resulttomonth)) {

                                                         $regdatemonth =  $rowpantomonth['registration'];
                                                         $registrationdatemonth = date("m", strtotime($regdatemonth));
                                                         if ($monthid == $registrationdatemonth) {
                                                            $imonth++;
                                                         }
                                                      }
                                                      echo $imonth;
                                                   }


                                                   ?>
                                                </strong>
                                             </h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER ID</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER ID</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      include('database/config.php');
                                                      $monthidfor = date('m');
                                                      $querytomonthfor = "SELECT * FROM details where agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                      $resulttomonthfor = mysqli_query($con, $querytomonthfor);
                                                      $counttomonthfor = mysqli_num_rows($resulttomonthfor);

                                                      if ($counttomonthfor > 0) {
                                                         $imonthfor = 0;
                                                         while ($rowpantomonthfor = mysqli_fetch_assoc($resulttomonthfor)) {

                                                            $regdatemonthfor =  $rowpantomonthfor['registration'];
                                                            $registrationdatemonthfor = date("m", strtotime($regdatemonthfor));
                                                            if ($monthidfor == $registrationdatemonthfor) {
                                                               $user_idmonthid = $rowpantomonthfor["user_id"];
                                                               $agent_usermonthid = $rowpantomonthfor["agent_user"];
                                                               $client_namemonthid = $rowpantomonthfor["client_name"];
                                                               $days = 1;
                                                               $status = $rowpantomonthfor["status"];
                                                               $user_type = $rowpantomonthfor["user_type"];
                                                               $mac = $rowpantomonthfor["mac"];
                                                               $registration = $rowpantomonthfor["registration"];
                                                               $timemodified = date('d-m-Y', strtotime($registration));
                                                               $admin_msg = $rowpantomonthfor["admin_msg"];
                                                               $payment = $rowpantomonthfor["payment"];
                                                               $super_payment = $rowpantomonthfor["super_pay"];
                                                               $admin_payment = $rowpantomonthfor["admin_pay"];
                                                               $expiry_date = $rowpantomonthfor["expiry_date"];
                                                               $activated = $rowpantomonthfor["activated"];
                                                               $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                               $ip_reg = date('Y-m-d H:i:sa', strtotime($registration));
                                                               $spnmonthid = "";
                                                               $sqlmonthidf = "SELECT super_name FROM userinfo where p_id='$agent_usermonthid' ";
                                                               $resultmonthidf = $con->query($sqlmonthidf);

                                                               if ($resultmonthidf->num_rows > 0) {
                                                                  $i = 1;
                                                                  while ($rowidmonth = $resultmonthidf->fetch_assoc()) {
                                                                     $spnmonthid = $rowidmonth["super_name"];
                                                                  }
                                                               }
                                                               $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                               $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);
                                                               $imonthfor++;

                                                      ?>
                                                               <tr>
                                                                  <td> <?php echo  $imonthfor; ?></td>
                                                                  <td <?php echo $m; ?>><?php echo $user_idmonthid; ?> </td>
                                                                  <td><?php echo $spnmonthid ?></td>
                                                                  <td><?php echo $agent_usermonthid ?></td>
                                                                  <td><?php echo $timemodified; ?></td>
                                                                  <td><?php echo  $timemodified1; ?></td>
                                                                  <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                                  <td><?php echo $k ?></td>
                                                               </tr>
                                                      <?php
                                                            }
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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
                                             <h4 class="text-light">
                                                <strong> Expired ID:
                                                   <?php
                                                   include('database/config.php');
                                                   $monthid = date('m');
                                                   $querytomonth = "SELECT * FROM details where DATE(expiry_date) < '$todaydate' and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name'))";
                                                   $resulttomonth = mysqli_query($con, $querytomonth);
                                                   $counttomonth = mysqli_num_rows($resulttomonth);
                                                   echo $counttomonth;
                                                   ?></strong>
                                             </h4>
                                          </div>
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                <table data-page-length='25' class="table table-hover table-bordered border-primary table-md display" id="" width="100%" cellspacing="0">
                                                   <thead>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </thead>
                                                   <tfoot>
                                                      <tr>
                                                         <th>SERIAL No.</th>
                                                         <th>KEY</th>
                                                         <th>SUPER ID</th>
                                                         <th>SELLER Id</th>
                                                         <th>Start Date</th>
                                                         <th>Expire Date</th>
                                                         <th>Left Days</th>
                                                         <th>Type</th>
                                                      </tr>
                                                   </tfoot>
                                                   <tbody>
                                                      <?php
                                                      if ($con->connect_error) {
                                                         die("Connection failed: " . $con->connect_error);
                                                      }

                                                      $name = $_SESSION['info']['username'];
                                                      $sqltodayid = "SELECT * FROM details where DATE(expiry_date) < '$todaydate' and agent_user in (Select p_id from userinfo where super_id in (Select sn from super where sub_admin_id = '$admin_name')) ";
                                                      $resulttodayid = $con->query($sqltodayid);

                                                      if ($resulttodayid->num_rows > 0) {
                                                         $i = 0;
                                                         $srl = 0;
                                                         // output data of each row
                                                         while ($rowtodayid = $resulttodayid->fetch_assoc()) {
                                                            $i = $i + 1;
                                                            $sn = $rowtodayid["sn"];
                                                            $user_id = $rowtodayid["user_id"];
                                                            $agent_user = $rowtodayid["agent_user"];
                                                            $client_name = $rowtodayid["client_name"];
                                                            $days = 1;
                                                            $status = $rowtodayid["status"];
                                                            $user_type = $rowtodayid["user_type"];
                                                            $mac = $rowtodayid["mac"];
                                                            $registrationtodayid = $rowtodayid["registration"];
                                                            $timemodified = date('d-m-Y', strtotime($registrationtodayid));
                                                            $admin_msg = $rowtodayid["admin_msg"];
                                                            $payment = $rowtodayid["payment"];
                                                            $super_payment = $rowtodayid["super_pay"];
                                                            $admin_payment = $rowtodayid["admin_pay"];
                                                            $expiry_date = $rowtodayid["expiry_date"];
                                                            $activated = $rowtodayid["activated"];
                                                            $timemodified1 = date('d-m-Y', strtotime($expiry_date));
                                                            $ip_reg = date('Y-m-d H:i:sa', strtotime($registrationtodayid));
                                                            $srl++;
                                                            $spn = "";
                                                            $sqlf = "SELECT super_name FROM userinfo where p_id='$agent_user' ";
                                                            $resultf = $con->query($sqlf);

                                                            if ($resultf->num_rows > 0) {
                                                               $i = 1;
                                                               while ($row = $resultf->fetch_assoc()) {
                                                                  $spn = $row["super_name"];
                                                               }
                                                            }

                                                            $ip_exp = date('Y-m-d H:i:sa', strtotime($expiry_date));

                                                            $day_left = strtotime(date('Y-m-d h:i:sa'));
                                                            $days = ceil((strtotime($timemodified1) - $day_left) / 60 / 60 / 24);

                                                            if ($days < 0) {
                                                               $m = 'bgcolor="#FFFF00"';
                                                               $renew = 'admin_renew.php?sn=' . $sn . '&id=' . $user_id;
                                                            } else {
                                                               $m = 'bgcolor="#FFF"';
                                                               $renew = "#";
                                                               $delete = "#";
                                                            }
                                                            if ($status == 1) {
                                                               $n = 'bgcolor="#00FF00"';
                                                               $ns = 'paid';
                                                            } else {
                                                               $n = 'bgcolor="#F00"';
                                                               $ns = 'due';
                                                            }

                                                            if ($user_type == 0) {
                                                               $k = 'DEMO';
                                                            } else {
                                                               $k = 'FULL VERSION';
                                                            }
                                                            if ($payment == 0) {
                                                               $l = 'offline';
                                                            } else {
                                                               $l = 'online';
                                                            }
                                                            if ($activated == 0) {
                                                               $o = '<center><img src="img/active.png"></center>';
                                                               $ol = 'deactivate';
                                                               $url = 'admin_seller_deactivate.php?sn=' . $sn . '&id=' . $user_id;;
                                                            } else {
                                                               $o = '<center><img src="img/deactive.png"></center>';
                                                               $ol = 'activate';
                                                               $url = 'admin_seller_activate.php?sn=' . $sn . '&id=' . $user_id;
                                                            }



                                                            if ($mac === "not_registered") {
                                                               # code...
                                                               $show = '<img src="img/mac1.png">';
                                                               $reset_url = '#';
                                                            } else {
                                                               # code...
                                                               $show = '<img src="img/mac.png">';
                                                               $reset_url = 'master_resetmac_id.php?sn=' . $sn . '&id=' . $user_id;
                                                            }





                                                            if ($con->connect_error) {
                                                               die("Connection failed: " . $con->connect_error);
                                                            }



                                                      ?>
                                                            <tr>
                                                               <td <?php //echo $m 
                                                                     ?>> <?php echo $srl; //$user_id 
                                                                        ?></td>
                                                               <td <?php echo $m; ?>><?php echo $user_id; ?> </td>
                                                               <td><?php echo $spn ?></td>
                                                               <td><?php echo $agent_user ?></td>
                                                               <td><?php echo $timemodified; ?></td>
                                                               <td><?php echo  $timemodified1; ?></td>
                                                               <td <?php echo $m ?>><?php echo $days; ?> </td>
                                                               <td><?php echo $k ?></td>
                                                            </tr>
                                                      <?php
                                                         }
                                                      } else {
                                                         echo "0 results";
                                                      } ?>
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