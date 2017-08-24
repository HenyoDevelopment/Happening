$(document).ready(function() {
    $("#fileToUpload").on('change', function() {
        image_preview(event);
    });
    
    // vertical align image-preview text
    $(".event-img-container").css({'line-height': ($(".event-img-container").innerHeight() + 'px')});
});
function image_preview(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('image_preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}