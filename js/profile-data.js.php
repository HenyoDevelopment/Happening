/*
    Docuement: profile-data.js.php
        This script is responsible for outputting all the data in every user's profile page including user info and events that they are going/interested/went

*/

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
                'size' => $recordArray['size'],
                'host_image' => get_host_image($recordArray['host'])
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

    function get_host_image($username){
        global $db;
        $sqlQuery = "SELECT * FROM `users` WHERE username ='$username';";
        $result = mysqli_query($db, $sqlQuery) or die(mysqli_error($db));
        $image = "img/profile-photos/";
        //OBTAINING DATA FROM DATABASE
        while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if($recordArray['profile_picture'] != "") {
                $image = $image.$recordArray['profile_picture'];
            } else {
                $image = "img/default-img/default0.jpg";
            }

            //echo $image . "\n";
        }

        return $image;
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
            events[i]['host_image'] -> user-image
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
        //alert(JSON.stringify(events));

        for (i = 0; i < events.length; i++) { 

            var html = template();
            $("#1b").append(html);
            /////////////
            //  IMAGE  //
            /////////////
            var image_location = "img/event_images/" + events[i]['image'];
            document.getElementById("event-image").setAttribute("id","event-image-" + i);
            document.getElementById("event-image-" + i).setAttribute("src", image_location);

            /////////////////
            // HOST IMAGE  //
            /////////////////
            document.getElementById("user-image").setAttribute("id","user-image-" + i);
            document.getElementById("user-image-" + i).setAttribute("src", events[i]['host_image']);


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
            var people = events[i]['users_going'].split(",");
            var cap = toTitleCase(events[i]['size']) + " Event &nbsp;&#183;&nbsp;" + people.length + " attendees";
            document.getElementById("event-capacity").setAttribute("id","event-capacity-" + i);
            document.getElementById("event-capacity-" + i).innerHTML = cap;

            //////////
            // TAGS //
            //////////
            document.getElementById("event-tags").setAttribute("id","event-tags-" + i);
            var match = events[i]['tags'].match(/\[(.*?)\]/); //Remove brackets
            var tags = match[1].split(",");

            //Output tags
            for (var j = 0; j < tags.length; j++) {
                tag = tags[j].replace (/"/g,'');
                tag = tag.trim(); //Remove trailing spaces
                tag = "<a class=\"tags\">#" + tag + "</a>&nbsp;";

                if (j + 1 < tags.length) 
                    tag += "&#183;&nbsp;";

                $("#event-tags-" + i).append(tag);
            }

            ///////////////////
            // LITNESS SCALE //
            ///////////////////
            document.getElementById("event-rating").setAttribute("id","event-rating-" + i);
            var size = events[i]['size'];
            var denominator = 25;
            if (size == "medium") {
                denominator = 53;
            }
            if (size == "big") {
                denominator = 115;
            } 
            if (size == "huge") {
                denominator = 250;
            }    

            var nominator = people.length;
            alert(nominator);
            var percentage = (nominator / denominator) * 100;
            var lit_scale = "img/default-img/";

            //NOT LIT
            if (percentage < 25){
                lit_scale = lit_scale + "not-lit.png";
            }

            //QUARTER LIT
            else if (percentage < 50 && percentage >= 25){
                lit_scale = lit_scale + "one-quarter-lit.png";
            }

            //HALF LIT
            else if (percentage < 75 && percentage >= 50){
                lit_scale = lit_scale + "half-lit.png";
            }

            //THREE QUARTERS LIT
            else if (percentage < 100 && percentage >= 75){
                lit_scale = lit_scale + "three-quarters-lit.png";
            }

            //FULL LIT
            else {
                lit_scale = lit_scale + "full-lit.png";
            }

            document.getElementById("event-rating-" + i).setAttribute("src", lit_scale);
        }

});