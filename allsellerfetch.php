<?php

$servername = "localhost";
$username = "u952853138_Hunterits";
$password = "Hunter@1988";
$dbname = "u952853138_Hunterits";

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}



$query = "SELECT * FROM details";
$query .= " WHERE ";
if(isset($_POST["is_category"]))
{
    $allcate = $_POST['is_category'];
    $query .= "agent_user in (SELECT p_id from userinfo where sn = '$allcate')";
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query);

$data = array();
$no = 1;
while($row = mysqli_fetch_array($result))
{
    
$startdate = $row['registration'];
$registrationdate = date("Y-m-d", strtotime($startdate));
$exipiredate = $row['expiry_date'];
$paidstatus = $row['admin_pay'];
$day_left = strtotime(date('Y-m-d h:i:sa'));
$exipiredatess = date('d-m-Y', strtotime($exipiredate));
$days = ceil((strtotime($exipiredatess) - $day_left) / 60 / 60 / 24);
 $sub_array = array();
 $sub_array[] = $no;
 $sub_array[] = $row["agent_user"];
 $sub_array[] = $row["user_id"];
 $sub_array[] = $registrationdate;
 $sub_array[] = $days;
 $sub_array[] = ($paidstatus==1) ? '<h5 class="text-success">YES</h5>':'<h5 class="text-danger">NO</h5>';
 $data[] = $sub_array;
 $no++;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM details";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
