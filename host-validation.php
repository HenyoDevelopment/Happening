
<?php
	//If Submit Button is hit and an Image was chosen
	if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])){

		// print_r($_FILES["fileToUpload"]);

		//DO THIS IN JAVASCRIPT
		// $filename = stripslashes($_FILES['fileToUpload']['name']);
		// $extension = getExtension($filename);
		// $extension = strtolower($extension);
		// if (($extension != "jpg") && ($extension != "jpeg") 
		// 	&& ($extension != "png") 
		// 	&& ($extension != "gif")){

		// 	echo ' Please upload an image. ';
		// 	$errors=1;
		// }
		
		//Image exceeds the PHP upload_max_filesize
		//Image Upload Error info http://php.net/manual/en/features.file-upload.errors.php
		//echo ini_get('upload_max_filesize');

    }

?>