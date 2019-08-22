<?php

$servername = "den1.mysql6.gear.host";
$username = "inventorymoog";
$password = "Ti6d-o4_bwPf";
$dbname = "inventorymoog";

$headerrow = 0;
$connect = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_POST["submit"]))
{
	mysqli_query($connect,"DELETE FROM ESDInventory WHERE *");
	if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle))
			{
				if($headerrow ==0){
					$headerrow = 1;
				}
				else{
					$model = mysqli_real_escape_string($connect, $data[0]);  
					$description = mysqli_real_escape_string($connect, $data[1]);
					$pcn = mysqli_real_escape_string($connect, $data[2]);
					$serial = mysqli_real_escape_string($connect, $data[3]);
					$calibration = mysqli_real_escape_string($connect, $data[5]);
					$area = mysqli_real_escape_string($connect, $data[4]);
					$name = mysqli_real_escape_string($connect, $data[6]);
					$checkoutDate = mysqli_real_escape_string($connect, $data[7]);
					$returnDate = mysqli_real_escape_string($connect, $data[8]);
					$query = "INSERT into ESDInventory(model, description, pcn, serial, area, calibration, name, checkoutDate, returnDate) values('$model','$description','$pcn','$serial','$area','$calibration','$name','$checkoutDate', '$returnDate')";
					mysqli_query($connect, $query);
				}
			}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
	}
}
	
header("Location: managementPage.php");
mysqli_close($connect);
?>