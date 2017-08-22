<?php
	require_once("init-database.php");
	session_start();
	
	$host = "localhost";
	$user = "bcuser";
	$password = "goodbyeWorld";
	$database = "Happening";
	$table1 = "users";
	$table2 = "events";
	
	$db = connectToDB($host, $user, $password, $database);
	$_SESSION['db'] = $db;
	
	function connectToDB($host, $user, $password, $database) {
		$db = mysqli_connect($host, $user, $password, $database);
		if (mysqli_connect_errno()) {
			echo "Connect failed.\n".mysqli_connect_error();
			exit();
		}
		return $db;
	}
?>