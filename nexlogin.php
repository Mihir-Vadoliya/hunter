<?php
include 'database/config.php';


$result = [
    'success' => false,
    'message' => 'Your license is Invalid Ya Another System register.. Plz Key Rest Connect Seller',
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

$query = "SELECT sn, user_id, mac, expiry_date,admin_pay FROM `u952853138_Hunterits`.`details` WHERE `user_id`= '$user_name'";
$stmnt = $conn->prepare($query);
$stmnt->execute();
$count = $stmnt->rowCount();

if ($count > 0) {
    $user = $stmnt->fetch(PDO::FETCH_ASSOC);
    $user_id = $user['sn'];
    $isPaid = $user['admin_pay'];
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
            'message' => 'THIS ID IS HAS BEEN EXPIRED. PLEASE CONNECT SELLER RENEW YOUR ID...',
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
    // else if ($user['activated'] == 1) {
    //     $result = [
    //         'success' => false,
    //         'message' => 'THIS ID IS HAS BEEN DEACTIVATED. PLEASE CONNECT SELLER RENEW YOUR ID...',
    //         'leftDays' => 0,
    //         'tokens' => null,
    //         'appVersion' => null,
    //         'ipList' => null,
    //         'ShortMessage' => null,
    //         'News' => null,
    //         'KeyType' => null,
    //         'PaidStatus' => null,
    //     ];
    //     exit(json_encode($result));
    // } else {
        $expireDateTime = new DateTime($user['expiry_date']);
        $todayDateTime = new DateTime($today);
        $interval = ($todayDateTime->diff($expireDateTime));

        $stmntsllr =  "SELECT `detusr_ip`,`detusr_port`,`detusr_pass`,`detusr_name` FROM `u952853138_Hunterits`.`detailsip` WHERE `detusr_key` = '$user_name'";
        $resultsllr = $conn->prepare($stmntsllr);
        $resultsllr->execute();

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
        $resultnews->execute();
        $usermulnews = $resultnews->fetch(PDO::FETCH_ASSOC);
        $adminnews = $usermulnews['news'];

        //echo $adminnews;
        $txt = 'Hunter News..20-Oct-2024@Dear User P Ho To Apane Admin Ko Boliye Muje SMS Kare Taki Software Ko Aur Behtar Kar Sake@..Thanks for Support By Hunter Ts..';
        $result = [
            'success' => true,
            'message' => 'null',
            'leftDays' => intval($interval->format('%a')),
            'tokens' => null,
            'appVersion' => "2024.10.18",
            'ipList' => implode("|--|", $ipList),
            'ShortMessage' => $txt,
            'News' =>  $adminnews,
            'KeyType' => 'monthly',
            'PaidStatus' => $isPaid,
            'DllVersion' => urlencode("https://traveltspower.in/MTS/IRCommDLL.dll"),
            'ChromeDriver' => '2222',
            'SaltKey' => '3333',
            'ChromeVersion' => '4444',
        ];
    //}
}


echo json_encode($result);
