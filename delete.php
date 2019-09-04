<?php

include 'establishConnection.php';
//$sql->bind_param("ss",$pcn,$serial);
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
$sql = sqlsrv_query($conn,"DELETE FROM ESDInventory WHERE pcn =? OR serial = ?",[$pcn,$serial]);
if($sql->affected_rows<=0){
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
