<?php
include('config.php');
?>
<?php
// date_default_timezone_set('Asia/Kolkata');
// if(isset($_REQUEST["mac_id"]))
// {
  
// 	$clieiid = $_REQUEST["mac_id"];
// 	if(isset($_REQUEST["serial"]) AND $_REQUEST["serial"]!=0){
// 	  $macadd = $_REQUEST["serial"];
// 	}
// 	else{
// 		$macadd = uniqid();
// 	}
//   	$query = "select * from details where user_id= '$clieiid'";
//     $row = 0 ;
//     // Execute the query and store the result set 
// 	$result = mysqli_query($con, $query); 
// 	if ($result) 
//     { 
//         // it return number of rows in the table. 
// 		$row = mysqli_num_rows($result); 
// 	}
	
// 	$checkresult= $row;
// 	$sn=0;
// 	if($checkresult == 1){
// 		$checkdaysquery = "select * from details where user_id = '$clieiid' ";
// 		$checkdayresult = mysqli_query($con,$checkdaysquery);
// 		$date=0;
// 		if($checkdayresult == true){
// 			$todayda = strtotime(date("Y-m-d"));
// 			while($dayrows = mysqli_fetch_array($checkdayresult)){
// 				$expiry_date=$dayrows["expiry_date"];
// 				$sn=$dayrows["sn"];
// 				//$macadd = $sn;
// 				$day_left=time();
//   				$date = ceil(($expiry_date - $day_left)/60/60/24);
// 			}
// 		}
// 		if($date>=0){

// 			$checkactivequery = "select * from details where user_id  = '$clieiid' ";
// 			$checkactiveresult = mysqli_query($con,$checkactivequery);
// 			$active=0;
// 			if($checkactiveresult == true){
// 				while($activerows = mysqli_fetch_array($checkactiveresult)){
// 					$active = $activerows["activated"];
// 				}
// 			}

// 			if($active == 0){
// 				$checkmacquey = "select mac from details  where user_id = '$clieiid'";
// 				$checkmacresult = mysqli_query($con,$checkmacquey);
// 				$macad = "";
// 				if($checkmacresult == true){
// 					while($macrows = mysqli_fetch_array($checkmacresult)){
// 						$macad = $macrows["mac"];
// 					}}
// 				if($macad == 'not_registered'){
// 					$macadd = rand(10000,100000);
// 					$resetmacquery = "update details SET mac  = '$macadd' where user_id = '$clieiid' ";
// 					$resetmac = mysqli_query($con,$resetmacquery);
// 					echo '{"license":"License is Active|'.$macadd.'|Your License key is valid for : '.$date.' days"}';
// 				}
// 				else{
// 					//echo $macad;
// 					//echo $macadd;
// 					if($macadd == $macad){
// 						echo '{"license":"License is Active|'.$macad.'|Your License key is valid for : '.$date.' days"}';
// 					}
// 					else{
// 						echo '{"license":"PLease reset ID!"}';
// 					}
// 				}
// 			}
// 			else{
// 				echo '{"license":"License is not active!"}';
// 			}
// 		}
// 		else{
// 			$deactive = "update details SET activated= 0 where user_id = '$clieiid'";
// 			$activeresult = mysqli_query($con,$deactive);
// 			echo '{"license":"License is in Expired!"}';
// 		}
// 	}
// 	else{
// 		echo '{"license":"License does not exist!"}';
// 	}

// }
// else{
// 	echo '{"license":"License does not exist!"}';
// }
 ?>