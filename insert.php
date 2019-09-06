<?php
//establish connection to database
include 'establishConnection.php';

//gather arguments from page form
$model = filter_input(INPUT_POST,'model');
$description = filter_input(INPUT_POST,'description');
$pcn = trim(filter_input(INPUT_POST,'pcn'));
$serial = trim(filter_input(INPUT_POST,'serial'));
$area = filter_input(INPUT_POST,'area');
$calibration = filter_input(INPUT_POST,'calibration');

//make sure that the pcn and serial number are entered in the form
if(empty($pcn)&&empty($serial)){
	header("Location: managementPage.php?insert=*FAILED to Insert Item. Please Enter a Serial Number or PCN*");
	sqlsrv_close($conn);
	exit();
}

//query the database and return to management page
$result = sqlsrv_query($conn, "INSERT INTO $tableName (model, description, pcn, serial, area, calibration) VALUES (?,?,?,?,?,?)", [$model,$description,$pcn,$serial,$area,$calibration,$result]);
header("Location: managementPage.php?insert=*SUCCESSFULLY Inserted Item*");
sqlsrv_close($conn);
?>