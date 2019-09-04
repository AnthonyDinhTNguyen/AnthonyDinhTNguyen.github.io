<?php
include 'establishConnection.php';
/*$servername = "den1.mysql6.gear.host";
$username = "inventorymoog";
$password = "Ti6d-o4_bwPf";
$dbname = "inventorymoog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */
//Prepare Statement

//$stmt->bind_param("ssssss", $model, $description, $pcn, $serial, $area, $calibration);

$model = filter_input(INPUT_POST,'model');
$description = filter_input(INPUT_POST,'description');
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$area = filter_input(INPUT_POST,'area');
$calibration = filter_input(INPUT_POST,'calibration');

if(empty($pcn)&&empty($serial)){
	header("Location: managementPage.php?insert=*FAILED to Insert Item. Please Enter a Serial Number or PCN*");
	sqlsrv_close($conn);
	exit();
}
$result = sqlsrv_query($conn, "INSERT INTO ESDInventory (model, description, pcn, serial, area, calibration) VALUES (?,?,?,?,?,?)", [$model,$description,$pcn,$serial,$area,$calibration,$result]);
header("Location: managementPage.php?insert=*SUCCESSFULLY Inserted Item*");
sqlsrv_close($conn);
?>