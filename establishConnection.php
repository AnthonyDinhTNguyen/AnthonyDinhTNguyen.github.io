<?php
$servername = "den1.mssql8.gear.host";
$username = "moogmssql";
$password = "Ju0UnRH6?VI~";
$dbname = "moogmssql";
$tableName = "ESDInventory";
// Create connection
$connectionInfo = array("Database"=>"moogmssql","UID"=>"moogmssql","PWD"=>"Ju0UnRH6?VI~");
$conn = sqlsrv_connect($servername, $connectionInfo);
// Check connection
/*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */
?>