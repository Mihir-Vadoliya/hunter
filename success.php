<?php
    include 'database/config.php';
    date_default_timezone_set("Asia/Kolkata");
    
    try {
        $query = "INSERT INTO `u952853138_Hunterits`.`tickets` (`UserID`, `Mac`, `Log`, `Src_Dest`, `TrainNo`, `Gateway`, `base64image`, `PNR_Time`, `Status`) VALUES (:UserID, :Mac, :Log, :Src_Dest, :TrainNo, :Gateway, :base64image, :PNR_Time, :Status)";
        $stmnt = $conn->prepare($query);
        $stmnt->bindParam(':UserID', $_REQUEST['UserID']);
        $stmnt->bindParam(':Mac', $_REQUEST['Mac']);
        $stmnt->bindParam(':Log', $_REQUEST['Log']);
        $stmnt->bindParam(':Src_Dest', $_REQUEST['Src_Dest']);
        $stmnt->bindParam(':TrainNo', $_REQUEST['TrainNo']);
        $stmnt->bindParam(':Gateway', $_REQUEST['Gateway']);
        $stmnt->bindParam(':base64image', $_REQUEST['base64image']);
        $stmnt->bindParam(':PNR_Time', date('Y-m-d H:i:sa', strtotime($_REQUEST['PNR_Time'])));
        $stmnt->bindParam(':Status', $_REQUEST['Status']);
        $stmnt->execute();        
    } catch (\Exception $ex) {
        echo(json_encode(["error" => $ex->getMessage()]));
        exit;
    }

    exit(json_encode(["status" => "success"]));