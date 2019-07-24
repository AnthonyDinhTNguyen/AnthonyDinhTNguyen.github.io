<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Prepare Statement
$stmt = $conn->prepare("UPDATE ESDInventory SET area = 'ESD LAB', returnDate = ? WHERE serial = ? OR pcn = ?");
$stmt->bind_param("sss",$returnDate, $serial, $pcn);

$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$returnDate = filter_input(INPUT_POST,'returnDate');

$continue = true;
if(empty($returnDate)){
	header("Location: index.php?return=*FAILED to return item. Please Enter The Return Date*");
	$stmt->close();
	$conn->close();
	exit();
}
elseif(empty($pcn)&&empty($serial)){
	header("Location: index.php?return=*FAILED to Return Item. Enter either a PCN or Serial Number*");
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
	header("Location: index.php?return=*SUCCESS. Item Returned*");
	$stmt->close();
	$conn->close();
	exit();
}
else{
	header("Location: index.php?return=*FAILED to Return Item. Please Check the Serial or PCN again*");
	$stmt->close();
	$conn->close();
	exit();
}
?>
