<?php
include 'establishConnection.php';

//get all entries of database
$result = sqlsrv_query($conn, "SELECT * FROM $tableName");
if ($result==false) die('Couldn\'t fetch records');
$num_fields = sqlsrv_num_fields($result);
$headers = array();
//write to csv
$fieldinfo = sqlsrv_field_metadata($result);
    for($i = 0; $i <count($fieldinfo); $i++)
        $headers[$i] = $fieldinfo[$i]["Name"];
$fp = fopen('php://output', 'w');
if ($fp && $result) {
	$fn = filter_input(INPUT_POST,'filename').".csv";
    header('Content-Type: text/csv');
    header("Content-Disposition: inline; filename=$fn");
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
sqlsrv_close($conn);
?>
