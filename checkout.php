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
//Prepare Statement
$stmt = $conn->prepare("UPDATE ESDInventory SET name = ?, checkoutDate = ?, area = ?, returnDate='' WHERE serial = ? OR pcn = ?");
$stmt->bind_param("sssss", $name, $checkoutDate, $area, $serial, $pcn);

$name = filter_input(INPUT_POST,'name');
$checkoutDate = filter_input(INPUT_POST,'checkoutDate');
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$area = filter_input(INPUT_POST,'area');
$continue = true;
if(empty($name)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Enter Your Name*");
	$stmt->close();
	$conn->close();
	exit();
}
elseif(empty($checkoutDate)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Enter The Checkout Date*");
	$stmt->close();
	$conn->close();
	exit();
}
elseif (empty($area)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Specify Where The Item Is Being Taken*");
	$stmt->close();
	$conn->close();
	exit();	
}
elseif(empty($pcn)&&empty($serial)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. The Serial Number or PCN is incorrect or not in the database*");
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
$stmt->execute();
if($stmt->affected_rows>=1){
	header("Location: index.php?checkout=*SUCCESS. Item Checked Out*");
	$stmt->close();
	$conn->close();
	exit();
}
else{
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Check the Serial or PCN again*");
	$stmt->close();
	$conn->close();
	exit();
}
?>
