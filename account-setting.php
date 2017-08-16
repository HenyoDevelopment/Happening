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

        <title>Account</title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/host.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head> 

    <body>
                <!--NAVIGATION BAR-->
        <div class="navbar navbar-default navbar-fixed-top">
            <a class="navbar-brand" href="explore.php">
                <img class="navbar-brand-logo" alt="Happening Logo" src="img/happening-logo.png">
            </a>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="navbar-search" placeholder="Search Event, User, or Tag">
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="host.php">Host</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a href="profile.php">Profile</a></li>
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
                                <div class="col-sm-4 input-description">Privacy: </div>
                                <select required class="col-sm-8" name="privacy" id="privacy">
                                    <option value="" disabled selected>Select your option</option>
                                    <option value="public">Public (Everyone can see your profile)</option>  
                                    <option value="private">Private (Only people who follows you can see your profile)</option>
                                </select>
                            </div>
                            <div class="row event-input-line">
                                <div class="col-sm-4 input-description">Description:</div> 
                                <textarea class="col-sm-8" name="description" id="description"  placeholder="More details leads to a better turnout"></textarea>
                            </div>
                            <input class="btn" id="submit-event" type="submit" name="submit" value="Update Profile"/>
                        </form>
                </div>
                <!-- FORM END -->

            </div>
        </div>

    </body>
</html>
