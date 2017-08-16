<?php
	//Database Variable Initialization	
	$host = "localhost";
	$user = "bcuser";
	$password = "goodbyeWorld";
	$database = "Happening";
	$table1 = "users";
	$table2 = "events";
	
	// Create connection to root
	$conn = new mysqli($host,"root","");
	
	//Check if connection fails
	if ($conn->connect_error) {
  	  die("Connection failed: " . $conn->connect_error);
	} 
	
	//Check if database - "Happening" exists
	$sqlQuery = "SHOW DATABASES";
	$result = $conn->query($sqlQuery);
	$found = false;
	while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		//"Happening" already exists
		if($recordArray['Database'] == $database) {
			$found = true;
			break;
		}
	}
	
	//create "Happening" Database if it does not exist
	if (!$found) {	
		
		//Create database
		$conn->query("CREATE DATABASE $database");	
		
		//Creater user
		$conn->query("CREATE USER '$user'@'$host' IDENTIFIED BY '$password'");
		
		//Grant user access to Database
		$conn->query( "GRANT ALL PRIVILEGES ON $database.* TO '$user'@'$host'");
		
		//CONNECT TO NEW DATABASE AND USER
		$conn = new mysqli($host, $user, $password, $database);	


		/////////////////////////////////////////////////
		//     CREATE TABLES IN HAPPENING DATABASE     //
		/////////////////////////////////////////////////

		//Create table for ALL events
		//Notes: Image is 16MB at most
		//Private is either 1 or 0; 0 is FALSE and 1 is TRUE
		//event_ID = host + event-name + start-date
		$conn->query("CREATE TABLE $table2(
						event_id varchar(100) primary key,
						name varchar(50), 
						host varchar(50),
						start_date date, 
						start_time time, 
						end_date date, 
						end_time time, 
						location varchar(100), 
						description varchar(500), 
						image MEDIUMBLOB,
						tags varchar(100),
						users_going varchar(100),
						size varchar(10),
						privacy varchar(10)
						)");
		
		//Create table for users
		//Notes: 
		//Friends is a serialized array of usernames
		//My_events & liked_events is a serialized array of event names
		//profile_picture is 16MB at most
		//Private is either 1 or 0; 0 is FALSE and 1 is TRUE
		$conn->query("CREATE TABLE $table1(
						email varchar(50) primary key,
						username varchar(50), 
						password varchar(250),
						name varchar(50),
						profile_picture MEDIUMBLOB,
						hosted_events varchar(100),
						interested_events varchar(100),
						going_events varchar(100),
						followers varchar(100),
						following varchar(100),
						points int,
						private int
						)");
	}
	
	$conn->close();
?>