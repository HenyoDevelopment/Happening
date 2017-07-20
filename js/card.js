// $(document).ready(function() {
//     $(".interest-btn").on('click',function(){
//         $(this).children('.icon-star, .icon-star-grey').toggleClass("icon-star icon-star-grey");
//     });
// });

$(document).ready(function() {
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