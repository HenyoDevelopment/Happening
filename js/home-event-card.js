$(document).ready(function() {
    function setEventCardSizeHome() {
        var eventCardWidth = $('#col-restriction').width() - 40;
        $(".card").css({'width': (eventCardWidth +'px')});
    };
    setEventCardSizeHome();
    $(window).resize(function() {
        setEventCardSizeHome();
    });
});