
<?php
	require_once("open-database.php");
?>

<?php
	//If Submit Button is hit and an Image was chosen
	if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){ 

		$image_name = time() . '_' . stripslashes($_FILES['fileToUpload']['name']);
		$privacy = trim($_POST["privacy"]);
		$description = trim($_POST["description"]);
		$username = $_SESSION['usernameValue'];

		//print_r($_SESSION);
		/************************/
        /*  Image Processing     /
        /************************/
		$upload_dir = "../img/profile-photos";	// The directory for the images to be saved in
		$upload_path = $upload_dir."/";		// The path to where the image will be imap_savebody(imap_stream, file, msg_number)

		//Create the upload directory with the right permissions if it doesn't exist
		if(!is_dir($upload_dir)){
			mkdir($upload_dir, 0777);
			chmod($upload_dir, 0777);
		}

		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_path.$image_name);


		/************************/
        /*  Database Processing     /
        /************************/
        $conn = new mysqli($host, $user, $password,$database);

        //print_r($_SESSION);
        $sqlQuery = "UPDATE users SET profile_picture='$image_name', privacy='$privacy', description='$description' WHERE username='$username'";

		if ($conn->query($sqlQuery) === TRUE) {
			header("Location: ../profile.php");
		} else {

			//Check if event Already Exists
			$str = $conn->error;
			echo "Error:". $str;
		}
    }	
?>
