<?php 
     //Access the Database and do things with it
    require_once("open-database.php"); 

    $required = true;
    //If not editting, CLEAR ALL SESSIONS
    if(!isset($_POST["edit"])) {
        require_once("open-sessions.php"); 
        $required = false;
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

        <title>Create Event</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/host.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="js/host.js"></script>
        <script type="text/javascript" src="js/event-validation.js"></script>
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
                <li><a class="host-nav active" href="#">Host</a></li>
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
                              <img src="<?php echo $_SESSION['image_location']?>" id="preview" style="max-width: 400px;"/>
                            </div>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="preview_image(event)"> 
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">Event Title:</div> 
                                <input required class="col-sm-8" type="text" name="event-name" id="event-name" placeholder="Add a short and sweet title"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">Location:</div> 
                                <input required class="col-sm-8" type="text" name="location" id="location" placeholder="Make sure its easy to find"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">Start:</div> 
                                <input required class="col-sm-4" type="date" name="date-start" id="date-start"/> 
                                <input required class="col-sm-3 col-sm-offset-1" type="time" name="time-start" id="time-start"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">End:</div> 
                                <input required class="col-sm-4" type="date" name="date-end" id="date-end"/> 
                                <input required class="col-sm-3 col-sm-offset-1" type="time" name="time-end" id="time-end"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">Expected Attendance:</div>
                                <select required class="col-sm-8" name="event-size" id="event-size">
                                    <option value="" disabled selected>Select your option</option>
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
                                <input class="col-sm-8" type="text" name="tags" id="tags" placeholder="Choose attractive tags (Separate with commas)"/>
                            </div>
                            <input class="btn" id="submit-event" type="submit" name="submit" value="Create"/>
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