<?php
    require_once("php-helper/open-database.php");

    //If user is not logged in, prompt user to login
    if (!isset($_SESSION["usernameValue"])) {
        header("Location: get-started.php");
    }
?>

<?php
    $username = $_SESSION["usernameValue"];
    $profile_pic = "";
    $points = 0;
    $name = "";
    $description = "";

    $followers = "";
    $following = "";

    $hosted_events = "";
    $interested_events = "";
    $going_events = "";

    $sqlQuery = "SELECT * FROM `users` WHERE username ='$username';";
    $result = mysqli_query($db, $sqlQuery);

    //OBTAINING DATA FROM DATABASE
    while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $profile_pic = $recordArray['profile_picture'];
        $points = $recordArray['points'];
        $name = $recordArray['name'];
        $description = $recordArray['description'];
        $followers = $recordArray['followers'];
        $following = $recordArray['following'];
        $hosted_events = $recordArray['hosted_events'];
        $interested_events = $recordArray['interested_events'];
        $going_events = $recordArray['going_events'];
    }

    $upload_dir = "img/";
    $img_dir = "profile-photos/";
    $default_img = "default0.jpg";

    //USE DEFAULT PHOTO IF USER HAS NOT UPLOADED A PROFILE PHOTO
    if ($profile_pic == "") {
        $profile_pic = $upload_dir."default-img/".$default_img;
        //echo "empty";
    } else {
        $profile_pic = $upload_dir.$img_dir.$profile_pic;
         //echo $profile_pic;
    }

    //OBTAIN FOLLOWERS/FOLLOWING Data and count
    $followers = json_decode($followers, true);
    $followers_len = count($followers);
    $following = json_decode($following, true);
    $following_len = count($following);

    //Obtain all events info
    $hosted_events = json_decode($hosted_events, true);
    $interested_events = json_decode($interested_events, true);
    $going_events = json_decode($going_events, true);

    //Combine all events and sort which one is in the past.
    $all_events = array_merge($hosted_events, $interested_events, $going_events)

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="/Happening/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/Happening/favicon.ico" type="image/x-icon">

        <title><?php echo "@".$username?></title>
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
        <script src="js/profile-btn.js"></script>
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
                        <div class="col-sm-4">
                            <div class="profile-img-container">
                                <img class="profile-photo" src="<?php echo $profile_pic?>" alt="profile photo"> </img>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="user-info">
                                <div class="line-one">
                                    <div class="username">
                                        <h2>@<?php echo $username?></h2>
                                    </div>
                                    <div class="dropdown-container">
                                        <div class="dropdown div-inline">
                                            <button class="btn profile-settings-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                &#9662;
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right profile-settings-dropdown" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item settings-item" href="account-setting.php">Account Settings</a>
                                                <a class="dropdown-item settings-item" href="get-started.php">Log Out</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn profile-btn">
                                        <div class="own-profile-btn"></div>
                                    </div>
                                </div>
                                <div class="line-two">
                                    <div class="fullname">
                                        <h3><?php echo $name?></h3>
                                    </div>
                                </div>
                                <div class="line-three">
                                    <div class="bio">
                                        <p><?php echo $description?></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="line-four">
                                    <div class="points">
                                        <h4><b><?php echo $points?></b></h4>
                                        <h4>points</h4>
                                    </div>
                                    <div class="connections">
                                        <div class="dropdown div-inline connections-center">
                                            <button class="btn connections-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h4><b><?php echo $followers_len + $following_len?></b></h4>
                                                <h4>connections</h4>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right connections-dropdown" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#"><b><?php echo $followers_len?></b> followers</a>
                                                <a class="dropdown-item" href="#"><b><?php echo $following_len?></b> following</a>
                                            </div>
                                        </div>
                                    </div>
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
                                <!--MOONRISE CARD START-->
                                <div class="card event-card">
                                    <div class="card-header">
                                        <div class="header-user">
                                            <img class="header-user-img" src="img/profile-photos/moonrise-user.jpg" alt="">
                                        </div>
                                        <div class="header-text"><a class="user">moonrise</a></div>
                                    </div>
                                    <div class="img-container vertical-align">
                                        <img class="card-event-img" src="img/events/moonrise.jpg" alt="Moonrise Festival 2017">
                                    </div>
                                    <div class="event-size-indicator-huge"></div>
                                    <div class="card-block">
                                        <div class="card-text-container">
                                            <h4 class="card-title"><a class="event-link">$109.50 &#9679; Moonrise Festival 2017</a></h4>
                                            <p class="card-event-info">Sat Aug 12 @ 10:00 am &#183; 26 miles away</p>
                                            <p class="card-event-info">Huge Event &#183; 724 attendees</p>
                                            <p class="card-text">anhnestle, beefsta, and 48 others</p>
                                            <p class="card-tags">
                                                <a class="tags">#musicfestival</a>
                                            </p>
                                        </div>
                                        <div class="card-btn-container">
                                            <div class="card-btn">
                                                <img class="lit-rating" src="img/really-lit.png" alt="It's lit">
                                            </div>
                                            <div class="dropup-container">
                                                <div class="dropup div-inline">
                                                    <button class="btn card-btn interest-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i id="event-interest" class="card-icon icon-checkmark"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <a class="interest-item not-interested">Not Interested</a>
                                                        <a class="interest-item interested">Interested</a>
                                                        <a class="interest-item going">Going</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--MOONRISE CARD END-->
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
                                    <div class="event-size-indicator-midsize"></div>
                                    <div class="card-block">
                                        <div class="card-text-container">
                                            <h4 class="card-title"><a class="event-link">$5.00 &#9679; Technica 2017</a></h4>
                                            <p class="card-event-info">Fri Nov 5 @ 10:00 AM &#183; 0.5 miles away</p>
                                            <p class="card-event-info">Midsize Event &#183; 907 attendees </p>
                                            <p class="card-text">trishaaamazing, beaakahayon, and 58 others</p>
                                            <p class="card-tags">
                                                <a class="tags">#womenshackathon</a> &#183; 
                                                <a class="tags">#freefood</a>
                                            </p>
                                        </div>
                                        <div class="card-btn-container">
                                            <div class="card-btn">
                                                <img class="lit-rating" src="img/three-quarters-lit.png" alt="three quarters lit">
                                            </div>
                                            <div class="dropup-container">
                                                <div class="dropup div-inline">
                                                    <button class="btn card-btn interest-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i id="event-interest" class="card-icon icon-star-grey"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <a class="interest-item not-interested">Not Interested</a>
                                                        <a class="interest-item interested">Interested</a>
                                                        <a class="interest-item going">Going</a>
                                                    </div>
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