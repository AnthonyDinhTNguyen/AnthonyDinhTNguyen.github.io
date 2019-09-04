<?php

include 'establishConnection.php';
//Prepare Statement

//$stmt->bind_param("sssss", $name, $checkoutDate, $area, $serial, $pcn);

$name = filter_input(INPUT_POST,'nameCheck');
$checkoutDate = filter_input(INPUT_POST,'checkoutDateCheck');
$pcn = trim(filter_input(INPUT_POST,'pcnCheck'));
$serial = trim(filter_input(INPUT_POST,'serialCheck'));
$area = filter_input(INPUT_POST,'areaCheck');
$continue = true;
if(empty($name)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Enter Your Name*");
	sqlsrv_close($conn);
	exit();
}
elseif(empty($checkoutDate)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Enter The Checkout Date*");
	sqlsrv_close($conn);
	exit();
}
elseif (empty($area)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Specify Where The Item Is Being Taken*");
	sqlsrv_close($conn);
	exit();	
}
elseif(empty($pcn)&&empty($serial)){
	header("Location: index.php?checkout=*FAILED to Checkout Item. The Serial Number or PCN is incorrect or not in the database*");
	sqlsrv_close($conn);
	exit();
}
elseif(empty($pcn)){
	$pcn = "TEMP NAME TO PREVENT SQL FROM MATCHING EMPTY STRING TO EMPTY STRING IN DATABASE";
}
elseif(empty($serial)){
	$serial = "TEMP NAME TO PREVENT...";
}
$stmt = sqlsrv_query($conn, "UPDATE ESDInventory SET name = ?, checkoutDate = ?, area = ?, returnDate='' WHERE serial = ? OR pcn = ?",[$name, $checkoutDate, $area, $serial, $pcn]);
if($stmt->affected_rows>=1){
	header("Location: index.php?checkout=*SUCCESS. Item Checked Out*");
	sqlsrv_close($conn);
	exit();
}
else{
	header("Location: index.php?checkout=*FAILED to Checkout Item. Please Check the Serial or PCN again*");
	sqlsrv_close($conn);
	exit();
}
?>
