
<?php
	require_once("open-database.php"); 
?>

<?php
	$upload_dir = "img/event_images"; 				// The directory for the images to be saved in
	$upload_path = $upload_dir."/";				// The path to where the image will be saved
	
	//Create the upload directory with the right permissions if it doesn't exist
	if(!is_dir($upload_dir)){
		mkdir($upload_dir, 0777);
		chmod($upload_dir, 0777);
	}

	//If Submit Button is hit and an Image was chosen
	if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){ 

		$newName = time() . '_' . stripslashes($_FILES['fileToUpload']['name']);
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $upload_path.$newName)) {
            echo 'File ' .$newName. ' succesfully copied';
        }

        $conn = new mysqli($host, $user, $password,$database);

        //print_r($_SESSION);
        $sqlQuery = "INSERT INTO events (image) VALUES ('{$newName}');";
		if ($conn->query($sqlQuery) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $conn->error;
		}
    }	
?>