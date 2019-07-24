<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Inventory";

$headerrow = 0;
$connect = mysqli_connect($servername, $username, $password, $dbname);
if(isset($_POST["submit"]))
{
	if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle))
			{
					$model = mysqli_real_escape_string($connect, $data[1]);  
					$description = mysqli_real_escape_string($connect, $data[2]);
					$pcn = mysqli_real_escape_string($connect, trim($data[3]));
					$serial = mysqli_real_escape_string($connect, trim($data[4]));
					$calibration = mysqli_real_escape_string($connect, $data[6]);
					$found = mysqli_real_escape_string($connect, $data[7]);
					$area = mysqli_real_escape_string($connect, $data[5]);
					if(empty($found))
						$area = "Unknown";
					$query = "INSERT into ESDInventory(model, description, pcn, serial, area, calibration) values('$model','$description','$pcn','$serial','$area','$calibration')";
					mysqli_query($connect, $query);
			}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
	}
}
	
header("Location: managementPage.php");
mysqli_close($connect);
?>