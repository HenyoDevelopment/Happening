$(document).ready(function() {
    $("#fileToUpload").on('change', function() {
        image_preview(event);
    });

    $(".event-img-preview").attr("src", ("img/party-parrot/" + party_parrot()));

     // party parrot ftw
    function party_parrot() {
        var parrot_num = getRandomInt(0, 7);
        var parrot_type; 
        console.log(parrot_num);
        switch(parrot_num) {
            case 0: 
                parrot_type = "party_parrot.gif";
                break;
            case 1: 
                parrot_type = "shuffle_parrot.gif";
                break;
            case 2: 
                parrot_type = "stable_parrot.gif";
                break;
            case 3: 
                parrot_type = "mustache_parrot.gif";
                break;
            case 4: 
                parrot_type = "fiesta_parrot.gif";
                break;
            case 5: 
                parrot_type = "aussie_conga_parrot.gif";
                break;
            case 6: 
                parrot_type = "triplets_parrot.gif";
                break;
        }
        console.log(parrot_type)
        return parrot_type;
     }
    
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

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
}