<?php 
     //Access the Database and do things with it
    require_once("open-database.php"); 


    //USED if the size of the image is Valid
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

<script type='text/javascript'>

    //Function for showing the image preview
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    //Form validation
    function validateForm() {  
        var return_value = true;
        var error = "";
        document.getElementById("error").innerHTML = "";

        /************************/
        /*  IMG FILE VALIDATION  /
        /************************/ 
        var input = document.getElementById('fileToUpload');
        var image =  input.value;
        var file = input.files[0];

        //Uploaded file MUST be an Image
        var dotIndex = image.lastIndexOf('.');
        var ext = (image.substring(dotIndex).toLowerCase());
        if ((ext != ".jpg") && (ext != ".jpeg") && (ext != ".png") && (ext != ".gif")) {
            error += "<br>Upload a valid image file.";
            return_value = false;
        }

        //IF image size is bigger than maximum possible size
        var upload_max_filesize = <?php echo $bytes?>;
        if (file && file.size > upload_max_filesize) {
            error += "<br>File is too large. Must be 2MB or less.";
            return_value = false;
        }

        /************************/
        /*    Input VALIDATION   /
        /************************/

        //NAME VALIDATION 
        var event_name = document.getElementById('event-name').value;
        if (event_name.length > 50) {
            error += "<br>Event Name is too long.";
            return_value = false;
        }

        //LOCATION VALIDATION
        var location = document.getElementById('location').value;
        if (location.length > 100) {
            error += "<br>Location is too long.";
            return_value = false;
        }

        //START DATE & TIME VALIDATION
        var today = new Date();
        var current_year = today.getFullYear();
        var current_month = today.getMonth() + 1;
        var current_day = today.getDate();
        var current_time = today.getHours();

        var date_start = document.getElementById('date-start').value;
        var time_start = document.getElementById('time-start').value;
        var start_date = date_start.split("-");
        var hour = time_start.split(":");

        var same_year = (start_date[0] == current_year );
        var same_month = (start_date[1] == current_month);
        var same_day = (start_date[2] == current_day);


        if (start_date[0] > current_year + 2) {
            error += "<br>Start date should be within 2 years from now.";
            return_value = false;
        } 
        
        if (start_date[0] < current_year) {
            error += "<br>Start date Year already passed.";
            return_value = false;
        } 

        if (same_year) {
            if (start_date[1] < current_month) {
                error += "<br>Start date Month already passed.";
                return_value = false;
            }    

            if (same_month){
                if (start_date[2] < current_day) {
                        error += "<br>Start date Day already passed.";
                        return_value = false;
                }
                if (same_day) {
                    if (hour[0] + 1 <= current_time) {
                        error += "<br>Start Time is too soon or has already passed.";
                        return_value = false;
                    }
                }
            }         
        }

        //End DATE & TIME VALIDATION
        var date_end = document.getElementById('date-end').value;
        var time_end = document.getElementById('time-end').value;
        var end_date = date_end.split("-");
        var end_hour = time_start.split(":");

        var same_year = (start_date[0] == end_date[0]);
        var same_month = (start_date[1] == end_date[1]);
        var same_day = (start_date[2] == end_date[2]);

        if (end_date[0] < start_date[0]) {
            error += "<br>End date Year is invalid.";
            return_value = false;
        }

        if (end_date[0] > start_date[0] + 2) {
            error += "<br>End date is too far in the future.";
            return_value = false;
        } 

        if (same_year) {
            if (end_date[1] < start_date[1]) {
                error += "<br>End date Month is invalid.";
                return_value = false;
            }

            if (same_month) {
                if (end_date[2] < start_date[2]) {
                    error += "<br>End date Day is invalid.";
                    return_value = false;   
                }

                if (same_day) {
                    if (end_hour[0] + 1 <= hour[0] + 1) {
                        error += "<br>Start Time is too soon or has already passed.";
                        return_value = false;
                    }
                }              
            }
        }

        //DESCRIPTION VALIDATION
        var description = document.getElementById('description').value;
        if (description.length > 500) {
            error += "<br>Description is too long.";
            return_value = false;
        }

        document.getElementById("error").innerHTML  = error;
        return return_value;

        // jQuery(function($) {
        //     $('#event-image').Jcrop();
        // });

        //alert(file.name + " " + file.size + " " + upload_max_filesize);
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
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="navbar-search" placeholder="Search Event, User, or Tag">
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="host-nav active" href="#host">Host</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="explore.html">Explore</a></li>
                <li><a href="profile.html">Profile</a></li>
            </ul>
        </div>

        <div class="container main-content">
            <div class="row row-centered">
                <div class="col-sm-8 col-sm-offset-2">

                <!-- FORM START -->
                <p id="error"> </p>
                <div class="form-container">
                    <form name="create-event-form" action="host-validation.php" method="POST" runat="server" enctype="multipart/form-data" onSubmit="return validateForm()">
                        <div class="event-img-preview">
                          <img id="preview" style="max-width: 400px;"/>
                        </div>
                        <input type="file" name="fileToUpload" id="fileToUpload" onchange="preview_image(event)"> 
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Event Title:</div> 
                            <input class="col-sm-8" type="text" name="event-name" id="event-name" placeholder="Add a short and sweet title"/>
                        </div>
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Location:</div> 
                            <input class="col-sm-8" type="text" name="location" id="location" placeholder="Make sure its easy to find"/>
                        </div>
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Start:</div> 
                            <input class="col-sm-4" type="date" name="date-start" id="date-start"/> 
                            <input class="col-sm-3 col-sm-offset-1" type="time" name="time-start" id="time-start"/>
                        </div>
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">End:</div> 
                            <input class="col-sm-4" type="date" name="date-end" id="date-end"/> 
                            <input class="col-sm-3 col-sm-offset-1" type="time" name="time-end" id="time-end"/>
                        </div>
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Expected Attendance:</div>
                            <select class="col-sm-8" name="event-size" id="event-size">
                                <option value="small">Small (25 and below)</option>  
                                <option value="medium">Medium (26-80)</option>
                                <option value="big">Big (80-149)</option>
                                <option value="huge">Huge (150 or more)</option>
                            </select>
                        </div>

                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Description:</div> 
                            <textarea class="col-sm-8" name="description" id="description"  placeholder="More details leads to a better turnout"></textarea>
                        </div>
                        <div class="row event-input-line">
                            <div class="col-sm-4 input-description">Tags:</div> 
                            <input class="col-sm-8" type="text" name="tags" id="tags" placeholder="Choose attractive tags"/>
                        </div>
                        <input class="btn "id="submit-event" type="submit" name="submit" value="Create"/>
                    </form>
                </div>
                <!-- FORM END -->

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

    </body>
</html>