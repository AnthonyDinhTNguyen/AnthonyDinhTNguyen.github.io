<?php
include 'establishConnection.php';

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
$result = sqlsrv_query($conn, "INSERT INTO $tableName (model, description, pcn, serial, area, calibration) VALUES (?,?,?,?,?,?)", [$model,$description,$pcn,$serial,$area,$calibration,$result]);
header("Location: managementPage.php?insert=*SUCCESSFULLY Inserted Item*");
sqlsrv_close($conn);
?>