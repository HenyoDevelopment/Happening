<?php
    require_once("open-database.php");

    debug_to_console("Hello!");

    $username = $_SESSION["usernameValue"];
    $name = trim($_POST["name"]);
    $bio = trim($_POST["bio"]);

    echo $name + $bio;

    $sql = "UPDATE $table1 SET name = $name, description = $bio WHERE username = $username";
    
    if(mysql_query($sql)) {
        echo "Update success!";
    } else {
        echo mysql_error();
    }

    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
?>