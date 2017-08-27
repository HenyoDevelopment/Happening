<?php
    require_once("php-helper/open-database.php");

    //If user is not logged in, prompt user to login
    if (!isset($_SESSION["usernameValue"])) {
        header("Location: get-started.php");
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
        <link rel="stylesheet" href="css/input-field.css">        
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/host.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtBCdPRCnQCF-MI78JOcc1e7Oly7Lth7I&libraries=places"></script>

        <script src="js/image-preview.js"></script>
        <script src="js/host.js"></script>
        <script src="js/google-autocomplete.js"></script>
        <script src="js/event-validation.js.php"></script>
    </head>
    <body onload="initAutocomplete()">
        
        <!--NAVIGATION BAR-->
        <div class="navbar navbar-default navbar-fixed-top">
            <a class="navbar-brand" href="explore.php">
                <img class="navbar-brand-logo" alt="Happening Logo" src="img/happening-logo.png">
            </a>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <span class="input input--hoshi navbar-search">
                        <input class="input__field input__field--hoshi navbar-search" id="search-input" type="text" placeholder="Search Event, User, or Tag"/>
                        <label class="input__label input__label--hoshi input__label--hoshi-color-1" id="search-underline"></label>
                    </span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="host-nav active" href="#">Host</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </div>

        <div class="container main-content">
            <div class="row row-centered">
                <div class="col-sm-10 col-sm-offset-1">

                    <!-- FORM START -->
                    <p id="error"> </p>
                    <div class="form-container">
                        <form name="create-event-form" action="php-helper/host-validation.php" method="POST" runat="server" enctype="multipart/form-data" onSubmit="return validateForm()">
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Event Image:</div>
                                <div class="col-sm-10">
                                    <input required type="file" name="fileToUpload" id="fileToUpload"> 
                                    <div class="event-img-container">
                                        <img id="image_preview" class="event-img-preview" alt="Uh oh. That's not a .png or .jpg file."> </img>
                                    </div>
                                </div>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Privacy:</div>
                                <select required class="col-sm-10" name="privacy" id="privacy">
                                    <option value="" disabled selected>Public or private event?</option>
                                    <option value="public">Public (Everyone can see it)</option>  
                                    <option value="private">Private (Only people you invite can see it)</option>
                                </select>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Event Title:</div> 
                                <input required class="col-sm-10 input-field" type="text" name="event-name" id="event-name" placeholder="Add a short and sweet title"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Location:</div> 
                                <input required class="col-sm-10 input-field" type="text" name="location" id="location" placeholder="Make sure its easy to find"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Start:</div> 
                                <input required class="col-sm-5 input-field" type="date" name="date-start" id="date-start"/> 
                                <input required class="col-sm-4 col-sm-offset-1 input-field" type="time" name="time-start" id="time-start"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">End:</div> 
                                <input required class="col-sm-5 input-field" type="date" name="date-end" id="date-end"/> 
                                <input required class="col-sm-4 col-sm-offset-1 input-field" type="time" name="time-end" id="time-end"/>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Expected Attendance:</div>
                                <select required class="col-sm-10 input-field" name="event-size" id="event-size">
                                    <option value="" disabled selected>Select your option</option>
                                    <option value="small">Small (25 and below)</option>  
                                    <option value="medium">Medium (26-80)</option>
                                    <option value="big">Big (81-149)</option>
                                    <option value="huge">Huge (150 or more)</option>
                                </select>
                            </div>

                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Description:</div> 
                                <textarea class="col-sm-10" name="description" id="description"  placeholder="More details leads to a better turnout"></textarea>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-2 input-description">Tags:</div> 
                                <input class="col-sm-10 input-field" type="text" name="tags" id="tags" placeholder="Choose attractive tags (Separate with commas)"/>
                            </div>
                            <input class="btn" id="submit-event" type="submit" name="submit" value="Create"/>
                            <div class="cancel-container">
                                <a>cancel</a>
                            </div>
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
                <h6><a>FAQ</a></h6>
            </div>
        </div>
        <!--FOOTER END-->

    </body>
</html>