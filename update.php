<?php
include 'establishConnection.php';
//Prepare Statement
//$stmt->bind_param("sssssssss", $model, $description, $calibration, $name, $checkoutDate, $area, $returnDate, $serial, $pcn);

$name = filter_input(INPUT_POST,'name');
$checkoutDate = filter_input(INPUT_POST,'checkoutDate');
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$area = filter_input(INPUT_POST,'area');
$model = filter_input(INPUT_POST,'model');
$description = filter_input(INPUT_POST,'description');
$calibration = filter_input(INPUT_POST,'calibration');
$returnDate = filter_input(INPUT_POST,'returnDate');

if(empty($pcn)&&empty($serial)){
	header("Location: managementPage.php?update=*FAILED to Update Item. Enter PCN or Serial Number*");
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
$sql = "SELECT model, description, calibration, name, checkoutDate, area, returnDate FROM ESDInventory WHERE serial = '$serial' OR pcn = '$pcn'";
$result = sqlsrv_query($conn,$sql);
if ($result!=false) {
	$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
	if(empty($name)){
		$name = $row['name'];
	}
	if(empty($checkoutDate)){
		$checkoutDate = $row['checkoutDate'];
	}
	if (empty($area)){
		$area = $row['area'];
	}
	if(empty($model)){
		$model = $row['model'];
	}
	if(empty($description)){
		$description = $row['description'];
	}
	if(empty($calibration)){
		$calibration = $row['calibration'];
	}
	if(empty($returnDate)){
		$returnDate = $row['returnDate'];
	}
}
$stmt = sqlsrv_query("UPDATE ESDInventory SET model = ?, description = ?, calibration = ?, name = ?, checkoutDate = ?, area = ?, returnDate=? WHERE serial = ? OR pcn = ?",[$model, $description, $calibration, $name, $checkoutDate, $area, $returnDate, $serial, $pcn]);
if(sqlsrv_rows_affected($stmt)>=1){
	header("Location: managementPage.php?update=*SUCCESS. Item Updated*");
	sqlsrv_close($conn);
	exit();
}
else{
	header("Location: managementPage.php?update=*FAILED to Update Item. Serial Number/PCN are incorrect, or are not in the database*");
	sqlsrv_close($conn);
	exit();
}
?>
<html>
<body>
<a href="managementPage.php">Click to return to database management page
</a>
</body>
</html>