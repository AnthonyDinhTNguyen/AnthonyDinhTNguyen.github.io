<?php

//connect to database
include 'establishConnection.php';

if(isset($_POST["submit"]))
{	//remove any remaining items from table (to preven duplicates when restoring)
	sqlsrv_query($conn,"DELETE FROM $tableName");

	//read from csv
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
					//gather data from csv and query database (insert)
					$model = $data[0];  
					$description = $data[1];
					$pcn = $data[2];
					$serial = $data[3];
					$calibration = $data[5];
					$area = $data[4];
					$name = $data[6];
					$checkoutDate =$data[7];
					$returnDate = $data[8];
					$query = "INSERT into $tableName(model, description, pcn, serial, area, calibration, name, checkoutDate, returnDate) values(?,?,?,?,?,?,?,?,?)";
					sqlsrv_query($conn, $query,[$model, $description,$pcn, $serial, $area, $calibration, $name, $checkoutDate, $returnDate]);
				}
			}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
		}
	}
}
	
header("Location: managementPage.php");
sqlsrv_close($conn);
?>