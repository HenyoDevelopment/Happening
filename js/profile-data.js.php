<?php
    require_once("../php-helper/open-database.php");
?>


/////////////////////////////////////////
// This PHP is used for profile info   //
/////////////////////////////////////////
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

///////////////////////////////
//  PHP HELPER METHODS START  //
///////////////////////////////
<?php

    //Returns all the details of an event based on Event_Id given
    //INCLUDING HOST'S PROFILE PHOTO
    function get_event($event_id) {
        $event_info = array();

        $sqlQuery = "SELECT * FROM `events` WHERE username ='$event_id';";
        $result = mysqli_query($db, $sqlQuery);

        //OBTAINING DATA FROM DATABASE
        while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $event_info = array (
                'name' => $recordArray['name'],
                'host' => $recordArray['host'],
                'start_date' => $recordArray['start_date'],
                'start_time' => $recordArray['start_time'],
                'end_date' => $recordArray['end_date'],
                'end_time' => $recordArray['end_time'],
                'location' => $recordArray['location'],
                'description' => $recordArray['description'],
                'image' => $recordArray['image'],
                'tags' => $recordArray['tags'],
                'users_going' => $recordArray['users_going'],
                'size' => $recordArray['size']
                );
        }

        return $event_info;
    }

    $present = array();
    $past = array();

    //Function that returns an array of all event info from $all_events 
    function get_all_events($event_list){
        //$event_list consists of Event_id strings


    }
?>
///////////////////////////////
//  PHP HELPER METHODS END    //
///////////////////////////////

function template() {
    var template = [
        '<div id="1" class="card event-card">',
                    '<div class="card-header">',
                        '<div class="header-user">',
                            '<img class="header-user-img" src="img/profile-photos/moonrise-user.jpg" alt="">',
                        '</div>',
                        '<div class="header-text"><a class="user">moonrise</a></div>',
                    '</div>',
                    '<div class="img-container vertical-align">',
                        '<img class="card-event-img" src="img/events/moonrise.jpg" alt="Moonrise Festival 2017">',
                    '</div>',
                    '<div class="event-size-indicator-huge"></div>',
                    '<div class="card-block">',
                        '<div class="card-text-container">',
                            '<h4 class="card-title"><a class="event-link">$109.50 &#9679; Moonrise Festival 2017</a></h4>',
                            '<p class="card-event-info">Sat Aug 12 @ 10:00 am &#183; 26 miles away</p>',
                            '<p class="card-event-info">Huge Event &#183; 724 attendees</p>',
                            '<p class="card-text">anhnestle, beefsta, and 48 others</p>',
                            '<p class="card-tags">',
                                '<a class="tags">#musicfestival</a>',
                            '</p>',
                        '</div>',
                        '<div class="card-btn-container">',
                            '<div class="card-btn">',
                                '<img class="lit-rating" src="img/full-lit.png" alt="It is lit">',
                            '</div>',
                            '<div class="dropup-container">',
                                '<div class="dropup div-inline">',
                                   '<button class="btn card-btn interest-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">',
                                        '<i id="event-interest" class="card-icon icon-checkmark"></i>',
                                   '</button>',
                                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">',
                                        '<a class="interest-item not-interested">Not Interested</a>',
                                        '<a class="interest-item interested">Interested</a>',
                                        '<a class="interest-item going">Going</a>',
                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',
                    '</div>',
                '</div>'
    ].join("\n");

    return template;
}

window.addEventListener('load', 
  function() { 
    
    //////////////////////////////////
    // User's info in profile page  //
    //////////////////////////////////
    document.getElementById("title").innerHTML = "@" + "<?php echo $username;?>";
    document.getElementById("username").innerHTML = "@" + "<?php echo $username;?>";
    document.getElementById("profile_picture").src = "<?php echo $profile_pic?>";
    document.getElementById("name").innerHTML = "<?php echo $name?>";
    document.getElementById("description").innerHTML = "<?php echo $description?>";
    document.getElementById("points").innerHTML = "<?php echo $points?>";
    document.getElementById("connections").innerHTML = "<?php echo $followers_len + $following_len?>";
    document.getElementById("followers").innerHTML = "<?php echo $followers_len?>";
    document.getElementById("following").innerHTML = "<?php echo $following_len?>";


    //////////////////////
    //   DIV CLONING    //
    //////////////////////
    //var div = document.getElementById('1');
    //var clone = div.cloneNode(true);

    //document.getElementById("1b").appendChild(template());

    var html = template();
    $("#1b").append(html)
  }, false);