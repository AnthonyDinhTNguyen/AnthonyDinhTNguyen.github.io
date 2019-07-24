<?php

$servername = "den1.mysql6.gear.host";
$username = "inventorymoog";
$password = "Ti6d-o4_bwPf";
$dbname = "inventorymoog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = $conn->prepare("DELETE FROM ESDInventory WHERE pcn =? OR serial = ?");
$sql->bind_param("ss",$pcn,$serial);
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));

if(empty($pcn)&&empty($serial)){
	header("Location: managementPage.php?delete=*FAILED to Delete Item. Enter a PCN or Serial Number*");
	$stmt->close();
	$conn->close();
	exit();
}
elseif(empty($pcn)){
	$pcn = "TEMP NAME TO PREVENT SQL FROM MATCHING EMPTY STRING TO EMPTY STRING IN DATABASE";
}
elseif(empty($serial)){
	$serial = "TEMP NAME TO PREVENT...";
}
$sql->execute();
if($sql->affected_rows<=0){
	header("Location: managementPage.php?delete=*FAILED to Delete Item. Enter a PCN or Serial Number*");
	$stmt->close();
	$conn->close();
	exit();
}
else{
	header("Location: managementPage.php?delete=*SUCCESSFULLY Deleted Item*");
	$stmt->close();
	$conn->close();
	exit();
}

?>
