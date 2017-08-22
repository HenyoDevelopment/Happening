<?php
    require("../php-helper/open-database.php");
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

    $present = array();
    $past = array();
    get_all_events($all_events);
    $present = json_encode($present);
    $past = json_encode($past);

    //Returns all the details of an event based on Event_Id given
    //INCLUDING HOST'S PROFILE PHOTO
    function get_event($event_id) {
        $event_info = array();
        global $db;

        $sqlQuery = "SELECT * FROM `events` WHERE event_id ='$event_id';";
        $result = mysqli_query($db, $sqlQuery) or die(mysqli_error($db));
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

    //Function that returns an array of all event info from $all_events 
    function get_all_events($event_list){
        //$event_list consists of Event_id strings
        global $past;
        global $present;

        //for each event 
        //  obtain info with get_event
        //  check if the date is past with end_date
        //      if past put it in past array
        //      else put in present array
        //end for
        foreach ($event_list as $event_id) {
            $info = get_event($event_id);  
            //print_r($info);   

            if ($info['end_date'] < date("Y-m-d")) {
                array_push($past, $info);
            } else {
                array_push($present, $info);
            }
        }
    }

    //Function to see which friends are going to an event
    //
?>
///////////////////////////////
//  PHP HELPER METHODS END   //
///////////////////////////////

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

window.addEventListener('load', function() { 
    
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
}, false);


//MUST WAIT FOR js/event-card-template.js before loading anything
$.getScript('js/event-card-template.js').done(function(){

        //Get all event information for PRESENT EVENTS

        //////////////////////
        //   DIV CLONING    //
        //////////////////////

        //var events = JSON.stringify(<?php echo $present?>);
        var events = <?php echo $present?>;

        /*
            variable-names              ID-names

            events[i]['host']       -> event-host
            events[i]['image']      -> event-image
            events[i]['name']       -> event-name
            events[i]['start_date'] -> date-time
            events[i]['start_time'] -> date-time
            events[i]['location']   ->  
            events[i]['tags']       -> tags
            events[i]['size']       -> capacity
            events[i]['users_going'] -> capacity

        */        


        //debugging purposes only
        //alert(events[0]['name']);
        
        var html = template();
        $("#1b").append(html);

        for (i = 0; i < events.length; i++) { 
            /////////////
            //  IMAGE  //
            /////////////
            events[i]['image'] = "img/event_images/" + events[0]['image'];
            document.getElementById("event-image").setAttribute("id","event-image-" + i);
            document.getElementById("event-image-" + i).setAttribute("src", events[i]['image']);


            //document.getElementById("user-image").setAttribute("src", events[i]['image']);

            //////////
            // Host //
            //////////
            document.getElementById("event-host").setAttribute("id","event-host-" + i);
            document.getElementById("event-host-" + i).innerHTML = events[i]['host'];

            ////////////////
            // Event Name //
            ////////////////
            document.getElementById("event-name").setAttribute("id","event-name-" + i);
            document.getElementById("event-name-" + i).innerHTML = events[i]['name'];

            ////////////////
            // Date-Time  //
            ////////////////
            document.getElementById("event-date-time").setAttribute("id","event-date-time-" + i);
            document.getElementById("event-date-time-" + i).innerHTML = events[i]['start_date'] + " @ " + events[i]['start_time'];

            ///////////////////////////////////
            // event-capacity & event-people //
            ///////////////////////////////////
            var cap = toTitleCase(events[i]['size']) + " Event &#183 " + events[i]['users_going'];
            document.getElementById("event-capacity").setAttribute("id","event-capacity-" + i);
            document.getElementById("event-capacity-" + i).innerHTML = cap;

        }

});