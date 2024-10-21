<?php
    include 'database/config.php';
    
    try {
        $query = "INSERT INTO `u952853138_Hunterits`.`tickets3` (`SrcDest`, `TrainNo`, `PayMode`, `Macid`, `userid`, `ip`, `tDate`, `img`, `pnr`) VALUES (:SrcDest, :TrainNo, :PayMode, :Macid, :userid, :ip, :tDate, :img, :pnr)";
        $stmnt = $conn->prepare($query);
        $stmnt->bindParam(':SrcDest', $_REQUEST['SrcDest']);
        $stmnt->bindParam(':TrainNo', $_REQUEST['TrainNo']);
        $stmnt->bindParam(':PayMode', $_REQUEST['PayMode']);
        $stmnt->bindParam(':Macid', $_REQUEST['Macid']);
        $stmnt->bindParam(':userid', $_REQUEST['userid']);
        $stmnt->bindParam(':ip', $_REQUEST['ip']);
        $stmnt->bindParam(':pnr', $_REQUEST['pnr']);
        
        $todaydate =  date('Y-m-d');
        
        $stmnt->bindParam(':tDate',$todaydate);
        $stmnt->bindParam(':img', $_REQUEST['img']); 

        $stmnt->execute();        
    } catch (\Exception $ex) {
        echo(json_encode(["error" => $ex->getMessage()]));
        exit;
    }

    exit(json_encode(["status" => "success"]));