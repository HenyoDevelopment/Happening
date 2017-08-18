<?php
    require_once("../php-helper/open-database.php");
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

  }, false);