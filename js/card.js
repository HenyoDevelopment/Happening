$(document).ready(function() {
    $(".img-container").css({'width': (   
        $('.friend-card').width()+'px')
    });
    function setEventCardSize() {
        $(".img-container").css({'width': (   
            $('.friend-card').width()+'px')
        });
    }
    $('.friend-card').resize(setEventCardSize);
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