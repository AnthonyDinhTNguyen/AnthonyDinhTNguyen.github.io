<?php
include 'establishConnection.php';

if(isset($_POST["submit"]))
{
	sqlsrv_query($conn,"DELETE FROM ESDInventory");

	if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1] == 'csv')
			echo "here";
		/*{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle))
			{
				if($headerrow ==0){
					$headerrow = 1;
				}
				else{
					/*$model = mysqli_real_escape_string($connect, $data[0]);  
					$description = mysqli_real_escape_string($connect, $data[1]);
					$pcn = mysqli_real_escape_string($connect, $data[2]);
					$serial = mysqli_real_escape_string($connect, $data[3]);
					$calibration = mysqli_real_escape_string($connect, $data[5]);
					$area = mysqli_real_escape_string($connect, $data[4]);
					$name = mysqli_real_escape_string($connect, $data[6]);
					$checkoutDate = mysqli_real_escape_string($connect, $data[7]);
					$returnDate = mysqli_real_escape_string($connect, $data[8]);
					$model = $data[0];  
					$description = $data[1];
					$pcn = $data[2];
					$serial = $data[3];
					$calibration = $data[5];
					$area = $data[4];
					$name = $data[6]);
					$checkoutDate =$data[7];
					$returnDate = $data[8];
					$query = "INSERT into ESDInventory(model, description, pcn, serial, area, calibration, name, checkoutDate, returnDate) values(?,?,?,?,?,?,?,?,?)";
					sqlsrv_query($conn, $query,[$model, $description,$pcn, $serial, $area, $calibration, $name, $checkoutDate, $returnDate]);
				}
			}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}*/
	}
}
	
header("Location: managementPage.php");
sqlsrv_close($conn);
?>