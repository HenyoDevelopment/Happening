<?php
    require("../php-helper/open-database.php");
?>

<?php
    $username = $_SESSION["usernameValue"];

?>

// going/interested/not interested event card function 
$(document).ready(function(){
  $(".not-interested").click(function() {
        $(this).parent()
               .siblings('.btn')
               .children('#event-interest')
               .attr('class', 'card-icon icon-star-grey');
    });
    $(".interested").click(function() {
        $(this).parent().siblings('.btn').children('#event-interest')
               .attr('class', 'card-icon icon-star');
    });
    $(".going").click(function() {
        $(this).parent().siblings('.btn').children('#event-interest')
               .attr('class', 'card-icon icon-checkmark');
    });
    $('#flip').click(function() {
        $('#panel').toggle('slide', {direction: 'down'}, 300);
    });
});