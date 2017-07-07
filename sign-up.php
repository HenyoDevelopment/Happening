<?php 
	require_once("open-database.php"); 
?>

<?php 
	//obtain all email/username from data base
	$sqlQuery = sprintf("select email, username from %s", $table1);
	$result = mysqli_query($db, $sqlQuery);
	
	$all_usernames = array();
	$all_emails = array();

	//Put all email/username in a PHP array
	if ($result) {
		while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$all_usernames[] = $recordArray["username"];
			$all_emails[] = $recordArray["email"];
		}
	}
	
	//Convert to a JavaScript Array
	$all_usernames = json_encode($all_usernames);
	$all_emails = json_encode($all_emails);
		
?>	

<script>
	/*
		Password must:
		Have at least 1 lowercase
		Have at least 1 uppercase
		Have at least 1 number
		Be at least 8 characters
	*/
	function validateForm() {	
	
		//Obtain User Input
		var password = document.forms["sign-up-form"]["password"].value;
		var username = document.forms["sign-up-form"]["username"].value;
		var email = document.forms["sign-up-form"]["email"].value;
		
		//Obtain JSON list from php
		var email_list = <?php echo $all_emails ?>;
		var username_list = <?php echo $all_usernames ?>;
		
		var message = "";
		
		//EMAIL VALIDATION
		if (email_list.includes(email)) {
			message += "Email Already Exists";
			document.getElementById("invalid-password").innerHTML = message;
			return false;
		}
		
		//USERNAME VALIDATION
		if (username_list.includes(username)) {
			message += "Username Already Exists";
			document.getElementById("invalid-password").innerHTML = message;
			return false;
		}
		
		//PASSWORD VALIDATION
		var strongRegex = 
			new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");
			
		if (password.length < 8) {
			message += "Password must be at least 8 characters.";
			document.getElementById("invalid-password").innerHTML = message;
			return false;
		}
			
		if (!strongRegex.test(password)) {
			message += "Password is too weak. Try again.";
			document.getElementById("invalid-password").innerHTML = message;
			return false;
		}
	}
</script>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sign Up</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head> 

    <body>
    	<!-- FORM (Input): Enter Username, and Password 
        	Notes: 
            	sign-up-validation.php - Inserts Data to DATABASE if it passes validateForm()
                validateForm()		   - Validates if the User Input Valid/acceptable
        -->
         <form name="sign-up-form" action="sign-up-validation.php" method="post" onSubmit="return validateForm()">
         	<h5 id="invalid-password"> 
            </h5>
         	<input type="email" name="email" placeholder="Email" required="true"/><br/>
            <input type="text" name="name" placeholder="Name" /><br/>
			<input type="text" name="username" placeholder="Username" required="true"/><br/>
          	<input type="password" name="password" placeholder="Password" required="true" /><br/>
	      	<input type="submit" name="submit" value="Create Account">
         </form>
         <!-- END FORM -->
         
    </body>
</html>