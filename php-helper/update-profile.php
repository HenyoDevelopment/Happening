<?php
    require_once("open-database.php");

    $username = $_SESSION["usernameValue"];
    $name = trim($_POST["name"]);
    $bio = trim($_POST["bio"]);

    // this isnt even ouputting...
    debug_to_console("Hello!");
    echo "Hello!";
    echo $name + $bio;

    $sqlQuery = "UPDATE $table1 SET name = $name, description = $bio WHERE username = $username";
    
    if(mysql_query($sqlQuery)) {
        echo "Update success!";
    } else {
        echo mysql_error();
    }

    // deubgging function
    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
?>