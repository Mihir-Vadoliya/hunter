<?php
include('super_head.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->

  <p class="mb-4"></p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Key</th>
              <th>Customer Name</th>
              <th>Panel Id</th>
              <th>MAC</th>
              <th>Start Date</th>
              <th>Left Days</th>
              <th>Action</th>
            </tr>

          </thead>
          <tfoot>
            <tr>
              <th>Key</th>
              <th>Customer Name</th>
              <th>Panel Id</th>
              <th>MAC</th>
              <th>Start Date</th>
              <th>Left Days</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php


            if ($con->connect_error) {
              die("Connection failed: " . $con->connect_error);
            }
            $name = $_SESSION['info']['s_id'];
            //$me=$_SESSION['info']['s_id'];

            $sql = "SELECT * FROM details where agent_user in (select p_id from userinfo where super_name='$name')";
            $result = $con->query($sql);
            $i = 0;
            //$sql = "SELECT * FROM details";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
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
                date_default_timezone_set("Asia/Kolkata");
                //$timemodified= date("d F Y H:i", $registration); 
                //$timemodified = date('d F Y h:i A', strtotime($timemodified));
                $timemodified = $registration;
                //echo $timemodified;
                $admin_msg = $row["admin_msg"];
                $payment = $row["payment"];
                $super_payment = $row["super_pay"];
                $admin_payment = $row["admin_pay"];
                $expiry_date = $row["expiry_date"];
                $activated = $row["activated"];
                //diff time stamp giving same time
                date_default_timezone_set("Asia/Kolkata");
                $timemodified1 = date("d F Y H:i", $expiry_date);
                $timemodified1 = date('d F Y h:i A', strtotime($timemodified1));
                //echo $timemodified1;
                $ip_reg = date('Y-m-d H:i:s', strtotime($registration));

                // echo $ip_reg;
                // echo $registration;

                //echo "string";
                //echo $expiry_date;
                $ip_exp = date('Y-m-d H:i:s', strtotime($expiry_date));
                //echo $ip_exp;       
                $day_left = time();
                $days = ceil((strtotime($expiry_date) - $day_left) / 60 / 60 / 24);
                //      $day_left=time();
                //$days = ceil(($expiry_date - $day_left)/60/60/24);

                if ($days <= 0) {
                  $m = 'bgcolor="#FFFF00"';
                  $renew = 'super_renew.php?sn=' . $sn . '&id=' . $user_id;
                } else {
                  $m = 'bgcolor="#FFF"';
                  $renew = "#";
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
                  //$o='activated';
                  $o = '<center><img src="img/active.png"></center>';
                  $ol = 'deactivate';
                  $url = 'super_deactivate_keys.php?sn=' . $sn . '&id=' . $user_id;;
                } else {
                  //$o='deactivated';
                  $o = '<center><img src="img/deactive.png"></center>';
                  $ol = 'activate';
                  $url = 'super_activate_keys.php?sn=' . $sn . '&id=' . $user_id;
                }

                $payment = $row["payment"];
                $super_payment = $row["super_pay"];
                $admin_payment = $row["admin_pay"];
                if ($payment == 1) {
                  $npay = 'bgcolor="#00FF00"';
                  $timestamp1 = $row["payment_date"];
                  // echo $timestamp1;

                  $nspay = 'paid on_' . date('d-m-Y', $timestamp1);
                  $urlpay = '#';
                } else {
                  $npay = 'bgcolor="#F00"';
                  $nspay = 'due';
                }
                if ($super_payment == 1) {
                  $nsuper = 'bgcolor="#00FF00"';
                  $timestamp1 = $row["super_pay_date"];
                  $nssuper = 'paid on_' . date('d-m-Y', $timestamp1);
                } else {
                  $nsuper = 'bgcolor="#F00"';
                  $nssuper = 'due';
                }
                if ($admin_payment == 1) {
                  $nadmin = 'bgcolor="#00FF00"';
                  $timestamp1 = $row["admin_pay_date"];
                  $nsadmin = 'paid on_' . date('d-m-Y', $timestamp1);;
                } else {
                  $nadmin = 'bgcolor="#F00"';
                  $nsadmin = 'due';
                }



                if ($mac === "not_registered") {
                  # code...
                  $show = '<img src="img/mac1.png">';
                  $reset_url = '#';
                } else {
                  # code...
                  $show = '<img src="img/mac.png">';
                  $reset_url = 'super_reset_id.php?sn=' . $sn . '&id=' . $user_id;
                }




                include('config.php');
                if ($con->connect_error) {
                  die("Connection failed: " . $con->connect_error);
                }

                $sql111 = "SELECT * FROM ipdetails  where mac_id='$user_id'";
                $result111 = $con->query($sql111);


                $rowcount111 = mysqli_num_rows($result111);
                $rowcount111 = ($rowcount111 * 2) + 2;
                //echo $rowcount11;


            ?>



                <tr>
                  <td <?php echo $m ?>> <?php echo $user_id ?></td>
                  <td><?php echo $client_name ?></td>
                  <td><?php echo $agent_user ?></td>
                  <td align="center"><a href="<?php echo $reset_url ?>"><?php echo $show ?></a></td>
                  <td><?php echo $timemodified; ?></td>
                  <td <?php echo $m ?>><?php echo $days; ?> </td>

                  <!-- <td><?php echo $k ?></td>
  <td <?php echo $m ?>><?php echo $rowcount111; ?> </td>
  <td>0</td> -->
                  <td><a href="<?php echo $url ?>"><?php echo $o ?></a></td>




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
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php
include('footer.php');
?>