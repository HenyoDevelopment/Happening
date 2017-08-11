$(document).ready(function() {
    // fix for setting correct size for description and event-size fields
    function setInputFieldSize() {
        var inputFieldWidth = $('#event-name').width() + 32;
        $("#description").css({'width': (inputFieldWidth +'px')});
        $("#event-size").css({'width': (inputFieldWidth +'px')});
    };
    setInputFieldSize();
    
    // calls above function when window resizes
    $(window).resize(function() {
        setInputFieldSize();
    })
});