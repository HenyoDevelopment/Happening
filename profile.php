<?php
    session_start();

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

        <title id="title"></title>
        <meta name="description" content="Happening App">
        <meta name="author" content="The Happening Team">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/icon.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script src="js/general-event-card.js"></script>
        <script src="js/interested.js"></script>
        <script src="js/follow-btn.js"></script>
        <script src="js/profile-edit.js"></script>


        <script src="js/profile-data.js.php"></script>
    </head> 

    <body>

        <!--NAVIGATION BAR -->
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
                <li><a class="host-nav" href="host.php">Host</a></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="explore.php">Explore</a></li>
                <li><a class="active" href="#profile">Profile</a></li>
            </ul>
        </div>
    
        <div class="container main-content">
            <div class="row row-centered">
                <div id="col-restriction" class="col-sm-8 col-sm-offset-2">

                    <!--PROFILE START-->
                    <div class="row row-centered profile-container">
                        <div class="col-xs-9">
                            <div class="user-info">
                                <div class="line-one">
                                    <div class="username">
                                        <h2 id="username"></h2>
                                    </div>
                                    <div class="dropdown-container">
                                        <div class="dropdown div-inline">
                                            <button class="btn profile-settings-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                &#9662;
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right profile-settings-dropdown" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item settings-item" href="#">Account Settings</a>
                                                <a class="dropdown-item settings-item" href="#">Log Out</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn profile-btn">
                                        <div class="edit-profile-btn"></div>
                                    </div>
                                </div>
                                <div class="line-two">
                                    <div class="fullname">
                                        <h3 id="name"></h3>
                                    </div>
                                </div>
                                <div class="line-four">
                                    <div class="points">
                                        <h4><b id="points"></b> points</h4>
                                    </div>
                                    <div class="connections">
                                        <div class="dropdown div-inline">
                                            <button class="btn connections-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h4><b id="connections"></b> connections</h4>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right connections-dropdown" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#"><b id="followers"></b> followers</a>
                                                <a class="dropdown-item" href="#"><b id="following"></b> following</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="profile-img-container">
                                <img id="profile_picture" class="profile-photo" src="img/profile-photos/gabe.png" alt="profile photo"> </img>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="line-three">
                                <div class="bio">
                                    <p id="description">TRUST. RESPECT. LOYALTY. LOVE. 💯 ✊ Be formless ☁️ Be water 🌊</p>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!--PROFILE END-->

                    <!--SECONDARY NAV START-->
                    <div id="event-stream">	
                        <ul class="nav nav-pills center-pills">
                            <li class="active"><a href="#1b" data-toggle="tab">Present</a></li>
                            <li><a href="#2b" data-toggle="tab">Past</a></li>
                        </ul>
                        <div class="tab-content clearfix">
                            <div class="tab-pane active" id="1b">
                                <!-- GO TO JS/event-card-template -->                 
                            </div>


                            <div class="tab-pane" id="2b">
                                <!--TECHNICA CARD START-->
                                <div class="card event-card">
                                    <div class="card-header">
                                        <div class="header-user">
                                            <img class="header-user-img" src="img/profile-photos/technica-user.png" alt="">
                                        </div>
                                        <div class="header-text"><a class="user">technica</a></div>
                                    </div>
                                    <div class="img-container vertical-align">
                                        <img class="card-event-img" src="img/events/technica.png" alt="Technica 2017">
                                    </div>
                                    <div class="event-size-indicator-medium"></div>
                                    <div class="card-block">
                                        <div class="card-text-container">
                                            <h4 class="card-title"><a class="event-link">$5.00 &#9679; Technica 2017</a></h4>
                                            <p class="card-event-info">Fri Nov 5 @ 10:00 AM &#183; 0.5 miles away</p>
                                            <p class="card-event-info">Medium Event &#183; 907 attendees </p>
                                            <p class="card-text">trishaaamazing, beaakahayon, and 58 others</p>
                                            <p class="card-tags">
                                                <a class="tags">#womenshackathon</a> &#183; 
                                                <a class="tags">#freefood</a>
                                            </p>
                                        </div>
                                        <div class="card-btn-container">
                                            <div class="card-btn">
                                                <img class="lit-rating" src="" alt="three quarters lit">
                                            </div>
                                            <div class="event-rating card-btn" type="button">
                                                <i id="event-interest" class="card-icon icon-unhappy"></i>
                                                <div class="rating-percentage">
                                                    <p>15%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TECHNICA CARD END-->

                                <div class="tab-pane" id="2b">
                                <!--TECHNICA CARD START-->
                                <div class="card event-card">
                                    <div class="card-header">
                                        <div class="header-user">
                                            <img class="header-user-img" src="img/profile-photos/technica-user.png" alt="">
                                        </div>
                                        <div class="header-text"><a class="user">technica</a></div>
                                    </div>
                                    <div class="img-container vertical-align">
                                        <img class="card-event-img" src="img/events/technica.png" alt="Technica 2017">
                                    </div>
                                    <div class="event-size-indicator-medium"></div>
                                    <div class="card-block">
                                        <div class="card-text-container">
                                            <h4 class="card-title"><a class="event-link">$5.00 &#9679; Technica 2017</a></h4>
                                            <p class="card-event-info">Fri Nov 5 @ 10:00 AM &#183; 0.5 miles away</p>
                                            <p class="card-event-info">Medium Event &#183; 907 attendees </p>
                                            <p class="card-text">trishaaamazing, beaakahayon, and 58 others</p>
                                            <p class="card-tags">
                                                <a class="tags">#womenshackathon</a> &#183; 
                                                <a class="tags">#freefood</a>
                                            </p>
                                        </div>
                                        <div class="card-btn-container">
                                            <div class="card-btn">
                                                <img class="lit-rating" src="" alt="three quarters lit">
                                            </div>
                                            <div class="event-rating card-btn" type="button">
                                                <i id="event-interest" class="card-icon icon-really-happy"></i>
                                                <div class="rating-percentage">
                                                    <p>94%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TECHNICA CARD END-->

                                <div class="tab-pane" id="2b">
                                <!--TECHNICA CARD START-->
                                <div class="card event-card">
                                    <div class="card-header">
                                        <div class="header-user">
                                            <img class="header-user-img" src="img/profile-photos/technica-user.png" alt="">
                                        </div>
                                        <div class="header-text"><a class="user">technica</a></div>
                                    </div>
                                    <div class="img-container vertical-align">
                                        <img class="card-event-img" src="img/events/technica.png" alt="Technica 2017">
                                    </div>
                                    <div class="event-size-indicator-medium"></div>
                                    <div class="card-block">
                                        <div class="card-text-container">
                                            <h4 class="card-title"><a class="event-link">$5.00 &#9679; Technica 2017</a></h4>
                                            <p class="card-event-info">Fri Nov 5 @ 10:00 AM &#183; 0.5 miles away</p>
                                            <p class="card-event-info">Medium Event &#183; 907 attendees </p>
                                            <p class="card-text">trishaaamazing, beaakahayon, and 58 others</p>
                                            <p class="card-tags">
                                                <a class="tags">#womenshackathon</a> &#183; 
                                                <a class="tags">#freefood</a>
                                            </p>
                                        </div>
                                        <div class="card-btn-container">
                                            <div class="card-btn">
                                                <img class="lit-rating" src="" alt="three quarters lit">
                                            </div>
                                            <div class="event-rating card-btn" type="button">
                                                <i id="event-interest" class="card-icon icon-happy"></i>
                                                <div class="rating-percentage">
                                                    <p>52%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--TECHNICA CARD END-->

                            </div>
                        </div>
                    </div>
                    <!--SECONDARY NAV END-->

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
    </body>
</html>