<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="/favicon.ico" type="image/ico">
        <link rel="icon" href="/favicon.ico" type="image/ico">


        <title>Login</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head> 

    <body>
    
    	<!-- FORM: Enter Username, and Password -->
         <form action="login-validation.php" method="post">
            <h5> 
				<?php 
					//If login_validation.php detects invalid match = true
					if (isset($_SESSION["invalid_match"]) && $_SESSION["invalid_match"]){
						//MESSAGE WHEN CREDENTIALS INPUT FAILS
						echo "Username and Password do not match."; 
						//Set it back to false
						$_SESSION["invalid_match"] = false;
					}
				?>
            </h5>
			<input type="text" name="username" placeholder="Username" required="true"/><br/>
          	<input type="password" name="password" placeholder="Password" required="true" /><br/>
	      	<input type="submit" name="submit" value="Sign In">
			<a href="sign-up.php"><button type="button">Sign Up</button></a><br>
         </form>
         <!-- END FORM -->
         
    </body>
</html>