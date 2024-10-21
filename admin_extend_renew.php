
<?php 
include('config.php'); 
include('admin_validate_login.php'); 


//include('config1.php'); 

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 



date_default_timezone_set("Asia/Kolkata");
 $reg_date=time();
$sn=$_GET["sn"];
$id=$_GET["id"];

$sn =  $con->real_escape_string($sn);
$id =  $con->real_escape_string($id);
echo $sn;
if ($sn != "786678"){

    $id=0;
    echo "hi";
exit;
}
$status=0;
	$reg_date=time();
	$payment=0;
	$expiry_date=strtotime('+'.$id.' day', $reg_date);
	$payment=0;
	$admin_pay=0;
	$super_pay=0;

    $sql = "SELECT * FROM details ";
    $result = $con->query($sql);
    
    $i=0;
    //$sql = "SELECT * FROM details";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          //  echo "id: " . $row["sn"]. $row["agent_user"] . $row["user_id"]. $row["client_name"] . $row["status"].$row["user_type"].$row["mac"].$row["registration"].$row["admin_msg"].$row["payment"].$row["expiry_date"].$row["activated"]."<br>";
         // $expiry_date=$row["expiry_date"];
          //=strtotime('+'.$id.' day', $expiry_date);
          //$sn= $row["sn"];
          
            $expiry_date=$row["expiry_date"];
          $expiry_date_n=date("Y-m-d H:i:s",strtotime('+'.$id.' day', strtotime($expiry_date)));
          $sn= $row["sn"];

$sql = "UPDATE details SET expiry_date='$expiry_date_n' where sn='$sn' ";
            $test1 = $con->query($sql) ;
        }
    }
if ( $test1 === TRUE) {
    header('location:admin_id.php?id=success'.$id.'days');
		exit;
} else {
  header('location:admin_id.php?id=fail');
		exit;
}






?>

