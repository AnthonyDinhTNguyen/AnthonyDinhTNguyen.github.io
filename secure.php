<?php
$user = "";
$password = "";
if(isset($_POST['user']))
	$user = $_POST['user'];
if(isset($_POST['pass']))
	$pass = $_POST['pass'];

if($user == "admin"
&& $pass == "admin")
{
        include("managementPage.php");
}
else
{
	include("loginform.html");
}
?>