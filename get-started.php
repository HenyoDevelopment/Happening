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

        <link rel="shortcut icon" href="/Happening/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/Happening/favicon.ico" type="image/x-icon">

        <title>Happening</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/get-started.css">
		</script>
    </head> 

    <body>

		<div class="container-fluid main-content">
            <div class="row box-container">
                <div class="login-container">

						<a class= "navbar-brand-logo" href="get-started.php">
                    		<img class="navbar-brand-full" alt="Happening Logo" src="img/happening-full.png">
						</a>
						<div id="exTab3">	
							<ul class="nav nav-pills center-pills">
								<li class="active"><a href="#1b" data-toggle="tab">Sign In</a></li>
								<?php $_SESSION["dir"] = "#1b"?>
								<li><a href="#2b" data-toggle="tab">Sign Up</a></li>
							</ul>
							<div class="tab-content clearfix">
								<div class="tab-pane active" id="1b">
									<div class="text-container">
										<h3>Log in to continue</h3>
									</div>
									<!--LOGIN FORM START: Enter Username, and Password-->
									<form action="login-validation.php" method="post">
										<div class="text-container error">
											<?php 
												//If login_validation.php detects invalid match = true
												if (isset($_SESSION["invalid_match"]) && $_SESSION["invalid_match"]){
													//MESSAGE WHEN CREDENTIALS INPUT FAILS
													echo "Username and Password do not match."; 
													//Set it back to false
													$_SESSION["invalid_match"] = false;
												}
											?>
										</div>
										<input type="text" name="username" placeholder="Username" required="true"/><br/>
										<input type="password" name="password" placeholder="Password" required="true" /><br/>
										<div class="btn-holder">
											<input type="submit" name="submit" value="Sign In">
										</div>
									</form>
									<!--LOGIN FORM END-->
								</div>


								<div class="tab-pane" id="2b">
									<div class="text-container">
										<h4>Happening is currently in limited release</h4>
										<h3>Sign up now to reserve your username</h3>
									</div>
									<!--SIGN UP FORM START (Input): Enter Username, and Password 
										Notes: 
											sign-up-validation.php - Inserts Data to DATABASE if ()		   - Vait passes validateForm()
											validateFormlidates if the User Input Valid/acceptable
									-->
									<form name="sign-up-form" action="sign-up-validation.php" method="post" onSubmit="return validateForm()">
										<div class="text-container error">
											<p id="invalid-password"> </p>
										</div>
										<input type="email" name="email" placeholder="Email" required="true"/><br/>
										<input type="text" name="name" placeholder="Name" /><br/>
										<input type="text" name="username" placeholder="Username" required="true"/><br/>
										<input type="password" name="password" placeholder="Password" required="true" /><br/>
										<div class="btn-holder">
											<input type="submit" name="submit" value="Give Me Access!">
										</div>
										<!-- <div class="text-container">
										</div> -->
									</form>
									<!--SIGN UP FORM END-->
								</div>
							</div>
						</div>
					</div>
				</div>

			<!--FOOTER START-->
            <div class="row">
                <div class="footer"> 
                    <h6><a>About Us</a></h6>
                    <h6>&copy; 2017 Happening</h6>
                    <h6><a>Contact</a></h6>
                </div>
            </div>
            <!--FOOTER END-->
			</div>



		</div>
    </body>

	<!-- Needed FOR TABS TO WORK-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</html>