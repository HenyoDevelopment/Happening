// event card size for most pages
$(document).ready(function() {
    function setEventCardSize() {
        var eventCardWidth = $('#col-restriction').width();
        $(".card").css({'width': (eventCardWidth +'px')});
    };
    setEventCardSize();
    $(window).resize(function() {
        setEventCardSize();
    });
});