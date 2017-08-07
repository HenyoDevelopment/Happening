<?php 
     //Access the Database and do things with it
    require_once("open-database.php"); 

      function return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= (1024 * 1024 * 1024); //1073741824
                break;
            case 'm':
                $val *= (1024 * 1024); //1048576    
                break;
            case 'k':
                $val *= 1024;
                break;
        }

        return $val;
    }

    $bytes = return_bytes(ini_get('upload_max_filesize'));
    $bytes = json_encode($bytes);
?>

<script>

    function validateForm() {   
        var input = document.getElementById('fileToUpload')
        var image =  input.value;
        var file = input.files[0];

        //Uploaded file MUST be an Image
        var dotIndex = image.lastIndexOf('.');
        var ext = (image.substring(dotIndex).toLowerCase());
        if ((ext != ".jpg") && (ext != ".jpeg") && (ext != ".png") && (ext != ".gif")) {
            document.getElementById("upload-error").innerHTML = "File is not an Image.";
            return false;
        }

        var upload_max_filesize = <?php echo $bytes?>;

        alert(file.name + " " + file.size + " " + upload_max_filesize);


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

        <title>Happening Discover Page</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
    </head> 

    <body>
        
        <!--NAVIGATION BAR-->
        <div class="navbar navbar-default navbar-fixed-top">
            <a class="navbar-brand" href="explore.html">
                <img class="navbar-brand-logo" alt="Happening Logo" src="img/happening-logo.png">
            </a>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="navbar-search" placeholder="Search Event or User">
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="host-nav active" href="#host">Host</a></li>
                <li><a href="home.html">Home</a></li>
                <li><a href="explore.html">Explore</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
        </div>

        <!-- FORM START -->
        <div>   

            <br/><br/><br/>
           <form name="create-event-fomr" action="host-validation.php" method="POST" enctype="multipart/form-data" onSubmit="return validateForm()">
                        <!--
                <input type="text" name="event-name" placeholder="Event Name" required="true"/><br/>
                <input type="text" name="location" placeholder="Location" required="true"/><br/>
                Date Start: <input type="date" name="date-start" required="true"/>
                Time Start: <input type="time" name="time-start" required="true"/><br/>
                Date End: <input type="date" name="date-end" />
                Time End: <input type="time" name="time-end" /><br/>
                Expected Attendance: 
                <select name="event-size">
                    <option value="huge">Huge (150 or more)</option>
                    <option value="big">Big (80-149)</option>
                    <option value="medium">Medium (26-80)</option>
                    <option value="small">Small (25 and below)</option>
                </select> <br/>
                <textarea name="Description" rows="4" cols="50"  placeholder="Description"></textarea><br/>

                -->
                <input type="file" name="fileToUpload" id="fileToUpload"> 
                <p id="upload-error"> </p>
                <input type="submit" name="submit" value="Create Event" />
            </form>
        </div>
        <!-- FORM END -->

        <!--FOOTER START-->
        <div class="row">
            <div class="footer"> 
                <h6><a>About Us</a></h6>
                <h6>&copy; 2017 Happening</h6>
                <h6><a>Contact</a></h6>
            </div>
        </div>
        <!--FOOTER END-->

    </body>
</html>