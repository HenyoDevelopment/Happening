$(document).ready(function() {
    //toggle class on click
    $(".profile-btn").on('click', '.other-profile-following', function() {
        $(this).attr('class', 'other-profile-follow');
    });
    $(".profile-btn").on('click', '.other-profile-follow', function() {
        $(this).attr('class', 'other-profile-following');
    });
});