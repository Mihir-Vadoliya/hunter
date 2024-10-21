<?php
    include 'database/config.php';

    $result = [
    	'success' => false,
    	'message' => "Reset Your license",
    	'leftDays' => 0,
    	'tokens' => null,
    	'appVersion' => null,
    	'ipList' => null,
    	'ShortMessage' => null,
    	'News' => null,
    	'KeyType' => null,
    	'PaidStatus' => null,
    ];
    $user_name =  $_REQUEST['userName'];
   $isPaid = 1;
    //$isPaid = 0;
    $query = "SELECT sn, user_id, mac, expiry_date FROM `u952853138_Hunterits`.`details` WHERE `user_id`= '$user_name'";
    $stmnt = $conn->prepare($query);
    $stmnt->execute();
    $count = $stmnt->rowCount();
    if ($count > 0) {
        $user = $stmnt->fetch(PDO::FETCH_ASSOC);
        $user_id = $user['sn']; 
        $today = date('Y-m-d H:i:s');
        if (empty($user["mac"]) || $user["mac"] == "not_registered") {
            $mac = $_REQUEST['macAddress'];
            $query = "UPDATE `u952853138_Hunterits`.`details` SET `mac` = '$mac' WHERE `sn` = '$user_id'";
            $stmnt = $conn->prepare($query);
            $stmnt->execute();
        } else if (($user["mac"] != $_REQUEST['macAddress'])) {
            exit(json_encode($result));
        } else if ($user['expiry_date'] < $today) {
                $result = [
    	'success' => false,
    	'message' => "THIS ID IS HAS BEEN EXPIRED. PLEASE RENEW YOUR ID...",
    	'leftDays' => 0,
    	'tokens' => null,
    	'appVersion' => null,
    	'ipList' => null,
    	'ShortMessage' => null,
    	'News' => null,
    	'KeyType' => null,
    	'PaidStatus' => null,
    ];
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
            
            array_push($ipList, "$usrIP||$usrport||$usrnicknme||$usrpass");
        }
        
        $stmntnews =  "SELECT `news` FROM `u952853138_Hunterits`.`soft_news` WHERE `nno` = '1'";
        $resultnews = $conn->prepare($stmntnews);
        $resultnews -> execute();
        $usermulnews = $resultnews->fetch(PDO::FETCH_ASSOC);
        $adminnews = $usermulnews['news'];
        echo $adminnews;
        $txt ='04-Oct-2023@HDFC Debit Card Update Kar Diya gaya hai@BHIM AXIS Bypass Working hai Aap New Bypass Kar Sakta Hain@Agar Aapka WEB Login me Payment Page per jate ji Unable to Process Aur APP Login me Getting Payment Info per ruk jata hai to IRCTC ID ka Password Change Karke Login karen Problem Solve ho Jayegi@Unlimited Pair Option Update Kar Diya Giya hai@@Working Bank on WEB@{SBI: HDFC: HDFC_DEBIT: PAYZAP_DEBIT :UPI:BHIMAXISUPI: AIRTELMONEY}@@Working Bank on APP@{PAYTM BYPASS: HDFC: PAYZAP_DEBIT: UPI:BHIMAXISUPI}';
        $result = [
     'success' => true,
     'message' => 'null',
     'leftDays' => intval($interval->format('%a')),
     'tokens' => null,
     'appVersion' => "2023.05.05",
     'ipList' => implode("|--|", $ipList),
     'ShortMessage' => $txt,
     'News' => null,
     'KeyType' => 'monthly',
     'PaidStatus' => '',
     'DllVersion' => urlencode("https://newcowinn.online/updated/IRCommDLL.dll"),
     'ChromeDriver' => '2222',
     'SaltKey' => '3333',
     'ChromeVersion' => '4444',
        ];
        
    }

echo json_encode($result);