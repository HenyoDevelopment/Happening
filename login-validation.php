<?php 
	 //Access the Database and do things with it
	require_once("open-database.php"); 
?>
 
<?php
    if (isset($_POST["submit"])) {

        //Get USER INPUT
        $passwordValue = trim($_POST["password"]);
        $usernameValue = trim($_POST["username"]);

		//Obtain the database
        $sqlQuery = sprintf("select username, password from %s", $table1);
        $result = mysqli_query($db, $sqlQuery);
		
		$passed = false;

        //Check if Username exists and Password matches
        if ($result) {
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			
				//Search the array
                if ($recordArray["username"] == $usernameValue && 
					 password_verify($passwordValue, $recordArray["password"])) {//password_verify($passwordValue, $recordArray["password"])
					
                    //SAVE CREDENTIALS TO LOCAL MEMORY	
                    $_SESSION["passwordValue"] = $passwordValue;
                    $_SESSION["usernameValue"] = $usernameValue;
					
					$passed = true;
                    
                    //Redirect to HOME
                    header("Location: home.html");
                }
            }
			
			if ($passed == false) {
				//Username & Password do not match. Ask to input again
				$_SESSION["invalid_match"] = true;
				header("Location: get-started.php");
			}
    } else {
        $error = "Retrieving records failed.".mysqli_error($db);
    }
}
?>