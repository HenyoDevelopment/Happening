<?php
    require_once("open-database.php");

    //yea bruh idk
    $username = $_SESSION["usernameValue"];
    $name = trim($_POST["name"]);
    $bio = trim($_POST["bio"]);

    $sqlQuery = "UPDATE $table1 SET name = '$name', description = '$bio' WHERE username = '$username'";
    
    if(mysql_query($sqlQuery)) {
        echo "Update success!";
    } else {
        echo mysql_error();
    }
?>