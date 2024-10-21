<?php
    include 'database/config.php';

    $result = "Reset Your license";
    $user_name =  $_REQUEST['userName'];
    $query = "SELECT * FROM `u952853138_Hunterits`.`details` WHERE `user_id` = '$user_name'";
    $stmnt = $conn->prepare($query);
    $stmnt->execute();
    $count = $stmnt->rowCount();
    if ($count > 0) {
        $user = $stmnt->fetch(PDO::FETCH_ASSOC);
        $user_id = $user['sn'];
        $admin_pay = $user['admin_pay'];
        $createdDate = new DateTime($user['CreatedDate']);
        $today = date('Y-m-d H:i:s');

        $todayDate = new DateTime($today);
        $dayInterval = ($todayDate->diff($createdDate)); 
        $registorDays = abs(intval($dayInterval->format('%a')));
        
        
        if(($registorDays > 3 && $admin_pay == 0) || $user["activated"] == 1) 
        {
            
            $result = base64_encode("APKA ADMIN PAYMENT DUE HEIN, APNE SELLER SE CONTACT KRE!@##@@##@@##@@##@@##@0@##@@##@g@D@0@@@@@##@@##@@##@@##@@##@0@##@@##@@@@@0@@@@@@@@@##@");
            exit(json_encode($result));
        }

        if (empty($user["mac"]) || $user["mac"] == "not_registered") {
            $mac = $_REQUEST['macAddress'];
            $query = "UPDATE `u952853138_Hunterits`.`details` SET `mac` = '$mac' WHERE `sn` = '$user_id'";
            $stmnt = $conn->prepare($query);
            $stmnt->execute();
        } else if (($user["mac"] != $_REQUEST['macAddress']) || ($user['expiry_date'] < $today)) {
            $result = base64_encode("Your ID ['$user_name'] already registered on another SYSTEM, Please Contact Seller.@##@@##@@##@@##@@##@0@##@@##@g@D@0@@@@@##@@##@@##@@##@@##@0@##@@##@@@@@0@@@@@@@@@##@");
            exit(json_encode($result));
        }
        
        $expireDateTime = new DateTime($user['expiry_date']);
        $todayDateTime = new DateTime($today);
        $interval = ($todayDateTime->diff($expireDateTime)); 
        
        
        $stmntsllr =  "SELECT `detusr_ip`,`detusr_port`,`detusr_pass`,`detusr_name` FROM `u952853138_Hunterits`.`detailsip` WHERE `detusr_key` = '$user_name'";
        $resultsllr = $conn->prepare($stmntsllr);
        $resultsllr -> execute();
        
        $ipList = [];
        while ($usermulfield = $resultsllr->fetch(PDO::FETCH_ASSOC)) {
            $usrIP = $usermulfield['detusr_ip'];
            $usrport = $usermulfield['detusr_port'];
            $usrpass = $usermulfield['detusr_pass'];
            $usrnicknme = $usermulfield['detusr_name'];
            
            array_push($ipList, "$usrIP@@@@$usrport@@@@$usrnicknme@@@@$usrpass");
        }
        array_push($result, 'OK');
        array_push($result, $user_name);
        array_push($result, $usrIP);
        array_push($result, $usrport);
        array_push($result, $usrnicknme);
        array_push($result, $usrpass);
        array_push($result, $expireDateTime);
        $news1 ="*HAPPY INDEPENDENCY DAY ALL USERS WELCOME  }@@@@";
       /* $news2 = "2 - Apr - 2021@HELLO ";
        $news3 = "2- Apr - 2021@D@HELLO ";*/
      $f16f = "F16F9270971EAEAE8E313B32E8FF0814";
        $updaterlink = "http://tussypro.com/disent/update/Hunter.exe";
        $appversion = "2022.1.0.58";
        $dayleft = intval($interval->format('%a'));
        $paid = "SUPER PAID";
        $showversion = "2022.1.0.58";
        $pnr = "4";
        $one = "1";
        $zero = "0";
       // $ip = "159.65.149.95";
       // $port = "8069";
        
        $ips = implode("####", $ipList);
        $result = base64_encode("OK@##@$user_name@##@$dayleft@##@$pnr@##@$ips####@##@$showversion@##@$paid@##@$news1@##@$appversion@##@$updaterlink@##@$f16f@##@1@##@0@##@@##@@@@@0@@@@@@@@@##@73456");
    }

echo json_encode($result);