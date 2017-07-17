$(document).ready(function() {
    $(".interest-btn").on('click',function(){
        $(this).children('.icon-star, .icon-star-grey').toggleClass("icon-star icon-star-grey");
    });
});