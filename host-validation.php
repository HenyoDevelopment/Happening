
<?php
	require_once("open-database.php");
	//IGNORE THIS FOR NOW 
	//if ($_SESSION['image_location']) { 	
	// 	$_SESSION['og_location'] = $_SESSION['image_location'];
	// } 
	// require_once("open-sessions.php");
?>

<?php
	//If Submit Button is hit and an Image was chosen
	if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){ 

		$image_name = time() . '_' . stripslashes($_FILES['fileToUpload']['name']);
		$_SESSION['event_name'] = $event_name = trim($_POST["event-name"]);
		$_SESSION['location'] 	= $location = trim($_POST["location"]);
		$_SESSION['start_date'] = $start_date = trim($_POST["date-start"]);
		$_SESSION['start_time'] = $start_time = trim($_POST["time-start"]);
		$_SESSION['end_date'] 	= $end_date = trim($_POST["date-end"]);
		$_SESSION['end_time'] 	= $end_time = trim($_POST["time-end"]);
		$_SESSION['size'] 		= $size = trim($_POST["event-size"]);
		$_SESSION['description']= $description = trim($_POST["description"]);
		$_SESSION['tags'] 		= $tags = trim($_POST["tags"]);
		
		/************************/
        /*  Image Processing     /
        /************************/
		$upload_dir = "img/event_images";	// The directory for the images to be saved in
		$upload_path = $upload_dir."/";		// The path to where the image will be saved

		if ($image_name) {

			//Delete the old picture then change
			$_SESSION['image_name'] =  $image_name; 
			$_SESSION['image_location'] = $upload_path.$image_name;		
		} else {
			$_SESSION['image_location'] = $_SESSION['og_location'];
		}

		//Create the upload directory with the right permissions if it doesn't exist
		if(!is_dir($upload_dir)){
			mkdir($upload_dir, 0777);
			chmod($upload_dir, 0777);
		}

		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_path.$image_name);

		// if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_path.$image_name)) {
  //           echo 'File ' .$image_name. ' succesfully copied';
  //       }

  //       $conn = new mysqli($host, $user, $password,$database);

  //       //print_r($_SESSION);
  //       $sqlQuery = "INSERT INTO events(name, image) VALUES ('$name','{$image_name}');";
		// if ($conn->query($sqlQuery) === TRUE) {
		// 	echo "New record created successfully";
		// } else {
		// 	echo "Error: " . $conn->error;
		// }
    }	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="/Happening/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/Happening/favicon.ico" type="image/x-icon">

        <title>Create an Event</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/host.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="js/host.js"></script>

    </head> 

    <body>
        
        <!--NAVIGATION BAR-->
        <div class="navbar navbar-default navbar-fixed-top">
            <a class="navbar-brand" href="explore.html">
                <img class="navbar-brand-logo" alt="Happening Logo" src="img/happening-logo.png">
            </a>
            <form class="="form-group">
                    <input type="text" class="navbar-search" placeholder="Search Event, User, or Tag">
                </div>navbar-form navbar-left">
                <div class
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="host-nav active" href="#">Host</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="explore.html">Explore</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
        </div>

        <div class="container main-content">
            <div class="row row-centered">
                <div class="col-sm-8 col-sm-offset-2">

                	Preview: <br>
					
					<form action="home.php">
					    <input type="submit" value="Publish" />
					</form>

					<form action="edit.php" method="post">
					    <input type="submit" value="Edit" name="edit" />
					</form>

	                <img src="<?php echo $_SESSION['image_location']?>" style="max-width: 400px;"> <br>
					Name: 				<?php echo $event_name."<br>" ?>
					Location:			<?php echo $location."<br>" ?>
					Start: 				<?php echo $start_date." " ?>
										<?php echo $start_time."<br>" ?>
					End: 				<?php echo $end_date." " ?>
										<?php echo $end_time."<br>" ?>
					Expected Attendance:<?php echo $size."<br>" ?>
					Desctiption:		<?php echo $description."<br>" ?>
					Tags:				<?php echo $tags."<br>" ?>

                </div>
            </div>
        </div>
    </body>
</html>