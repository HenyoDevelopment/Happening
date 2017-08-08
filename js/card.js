$(document).ready(function() {
    function setEventCardSize() {
        var eventCardWidth = $('.friend-card').width() - 20
        $(".img-container").css({'width': (eventCardWidth +'px')});
    };
    setEventCardSize();
    $(window).resize(function() {
        setEventCardSize();
    });
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
            
});