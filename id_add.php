<?php
include('config.php');
date_default_timezone_set("Asia/Calcutta");
include('seller_login_validate.php');
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_SESSION['pan_id'];

    $name = preg_replace('/\s\s+/', ' ', $name);
    $id = strtoupper($_POST["userid"]);
    $uname = $_POST["userName"];
    $usertype = $_POST["UserType"];
    $status = 0;
    $user_type = 1;
    //$day_remaining=1;
    $reg_date = date('Y-m-d h:i:sa');
    $msg = "hello";
    
    if ($usertype == 1) {

        $expiry_dates = date('Y-m-d h:i:sa', strtotime('+30 days'));
        $expiry_date = date('Y-m-d h:i:sa', strtotime($expiry_dates));
        $user_type = 1;
        
        $payment = 0;
    } else {
        $expiry_dates = date('Y-m-d h:i:sa', strtotime('+2 days'));
        $expiry_date = date('Y-m-d h:i:sa', strtotime($expiry_dates));
        $user_type = 2;
        
        $payment = 1;
    }

    $activated = 0;

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $name1 = "not_registered";
    $sql17 = "SELECT * FROM userinfo where sn='" . $_SESSION['sellerid'] . "'";
    $result17 = $con->query($sql17);
    while ($row = $result17->fetch_assoc()) {
        $credit = $row["user_credit"];
    }

//     if ($credit < 1) {
//         $_SESSION['creditempty'] = "<h4 style='color:red';>You Have No Enough Credit...........!</h4>";
//         header('location:keys.php?id=nobalance');
// ?><script>
//             window.location = 'keys.php?id=';
//         </script>
// <?php
//         exit;
//     }

    if (!empty($name) && !empty($id)) {
        $sql = "insert into details (agent_user, user_id, client_name, status, user_type,mac,mob, registration, CreatedDate, admin_msg, admin_pay, expiry_date, activated) VALUES ('" . $name . "','" . $id . "','" . $uname . "','" . $status . "','" . $user_type . "','" . $name1 . "','" . $name1 . "','" . $reg_date . "','" . $reg_date . "','" . $msg . "','" . $payment . "','" . $expiry_date . "','" . $activated . "')";
    } else {
        echo "LOGIN AGAIN";
    }
    $url = "location:keys.php?id=SUCCESSFULLY_Added_User_ $id";
    // echo $sql;
    // exit();
    if ($con->query($sql) === TRUE) {

        if ($usertype == 1) {
            $newcredit = ($credit - 0);
        } else {
            $newcredit = $credit;
        }


        $sql = "update userinfo set user_credit = '$newcredit'  where sn='" . $_SESSION['sellerid'] . "'";
        $sql12 = "insert into credit_log (transaction_by, transaction_for, credit_amount, mode) VALUES ('" . $_SESSION['pan_id'] . "','" . $id . "','1','DEDUCT')";
        if ($con->query($sql) === TRUE and $con->query($sql12) === TRUE) {
        }

        header($url);
         $_SESSION['creditempty'] = "<h4 style='color:green';>ID Created Successfully...........!</h4>";
        exit;
    } else {
        header('location:keys.php?id=ID_EXISTS_TRY_DIFFERENT_ID');
        exit;
    }
}


?>