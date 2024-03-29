<?php

include 'establishConnection.php';

//get form information
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));

if(empty($pcn)&&empty($serial)){
	header("Location: managementPage.php?delete=*FAILED to Delete Item. Enter a PCN or Serial Number*");
	sqlsrv_close($conn);
	exit();
}
elseif(empty($pcn)){
	$pcn = "TEMP NAME TO PREVENT SQL FROM MATCHING EMPTY STRING TO EMPTY STRING IN DATABASE";
}
elseif(empty($serial)){
	$serial = "TEMP NAME TO PREVENT...";
}

//query database
$sql = sqlsrv_query($conn,"DELETE FROM $tableName WHERE pcn =? OR serial = ?",[$pcn,$serial]);
if(sqlsrv_rows_affected($sql)<=0){
	header("Location: managementPage.php?delete=*FAILED to Delete Item. Enter a PCN or Serial Number*");
	sqlsrv_close($conn);
	exit();
}
else{
	header("Location: managementPage.php?delete=*SUCCESSFULLY Deleted Item*");
	sqlsrv_close($conn);
	exit();
}

?>
