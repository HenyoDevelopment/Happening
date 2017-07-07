<?php 
	 //Access the Database and do things with it
	require_once("open-database.php"); 
?>
 
<?php
    if (isset($_POST["submit"])) {

        //Get USER INPUT
        $passwordValue = trim($_POST["password"]);
        $usernameValue = trim($_POST["username"]);

        $sqlQuery = sprintf("select * from %s", $table1);
        $result = mysqli_query($db, $sqlQuery);

        //Check if Username exists and Password matches
        if ($result) {
            while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if ($recordArray["username"] == $usernameValue && 
					password_verify($passwordValue, $recordArray["password"])) {
					
                    //SAVE CREDENTIALS TO LOCAL MEMORY	
                    $_SESSION["passwordValue"] = $passwordValue;
                    $_SESSION["usernameValue"] = $usernameValue;
                    
                    //Redirect to HOME
                    header("Location: home.php");
                }
            }
			
            //Username & Password do not match. Ask to input again
			$_SESSION["invalid_match"] = true;
			header("Location: login.php");
			
    } else {
        $error = "Retrieving records failed.".mysqli_error($db);
    }
}
?>