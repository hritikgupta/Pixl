<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	$hostname='localhost';
	$user = 'root';
	$password = 'abcd';
	$mysql_database = 'project';
	$db = mysqli_connect($hostname, $user, $password,$mysql_database);

	if (!$db){
        die("Connection failed: " . mysqli_connect_error());
	}
?>