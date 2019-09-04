<?php
$servername = "den1.mssql8.gear.host";
$username = "moogmssql";
$password = "Ju0UnRH6?VI~";
$dbname = "moogmssql";

// Create connection
$connectionInfo = array("Database"=>"moogmssql","UID"=>"moogmssql","PWD"=>"Ju0UnRH6?VI~");
$conn = sqlsrv_connect($servername, $connectionInfo);
// Check connection
/*if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */
if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>