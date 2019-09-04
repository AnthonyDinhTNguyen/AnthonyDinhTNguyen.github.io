<?php
include 'establishConnection.php';
//Prepare Statement

$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$returnDate = filter_input(INPUT_POST,'returnDate');
$continue = true;
if(empty($returnDate)){
	header("Location: index.php?return=*FAILED to return item. Please Enter The Return Date*");
	sqlsrv_close($conn);
	exit();
}
elseif(empty($pcn)&&empty($serial)){
	header("Location: index.php?return=*FAILED to Return Item. Enter either a PCN or Serial Number*");
	sqlsrv_close($conn);
	exit();
}
elseif(empty($pcn)){
	$pcn = "TEMP NAME TO PREVENT SQL FROM MATCHING EMPTY STRING TO EMPTY STRING IN DATABASE";
}
elseif(empty($serial)){
	$serial = "TEMP NAME TO PREVENT...";
}
//$stmt->execute();
$stmt = sqlsrv_query($conn,"UPDATE ESDInventory SET area = 'ESD LAB', returnDate = ? WHERE serial = ? OR pcn = ?",[$serial,$pcn]);
if(sqlsrv_rows_affected($stmt)>=1){
	header("Location: index.php?return=*SUCCESS. Item Returned*");
	sqlsrv_close($conn);
	exit();
}
else{
	header("Location: index.php?return=*FAILED to Return Item. Please Check the Serial or PCN again*");
	sqlsrv_close($conn);
	exit();
}
?>
