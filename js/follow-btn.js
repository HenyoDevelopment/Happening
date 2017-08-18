// toggle between following and not following
$(document).ready(function() {
    //toggles class on click
    $(".follow-btn").on('click', '.other-profile-following', function() {
        $(this).attr('class', 'other-profile-follow');
    });
    $(".follow-btn").on('click', '.other-profile-follow', function() {
        $(this).attr('class', 'other-profile-following');
    });
});