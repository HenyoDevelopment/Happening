<?php 
	 //Access the Database and do things with it
	require_once("open-database.php"); 
?>

<?php
	if (isset($_POST["submit"])) {
		//Get USER INPUT
		$email = trim($_POST["email"]);
		$name = NULL;
		$username = trim($_POST["username"]);
		$password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);//password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
		
		//Since name is optional, if it is set:
		if (isset($_POST["name"])) {
			$name = trim($_POST["name"]);
		}
		
		//INSERT USERT INPUT TO DATABASE w/ private being false
		$sqlQuery = sprintf("insert into $table1 (email, username, password, name, private) values ('%s', '%s', '%s', '%s', 0)", $email, $username, $password, $name);
		$result = mysqli_query($db, $sqlQuery);
		
		//Check if successful
		if (!$result) {
			$error = "Inserting records failed.".mysqli_error($db);
			//echo $error; //Debugging purposes
		} else {
			
			 //SAVE CREDENTIALS TO LOCAL MEMORY	
			$_SESSION["passwordValue"] = $password;
			$_SESSION["usernameValue"] = $email;
						
			//Redirect to their own home page
			header("Location: home.php");
		}
	}
?>