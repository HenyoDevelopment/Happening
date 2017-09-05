$(document).ready(function() {
	$(".edit-profile-btn").on("click", function() {
        if ($(".save-profile-btn")[0]){
            // saves profile 
            save_profile();
        } else {
            // BEGIN EDITING NAME
            var name_data = $(".fullname").children("h3");
            var name_id = name_data.attr("id");
            var new_name_id = name_id+"-form";
            var curr_name_val = name_data.text();
            name_data.empty();

            // BEGIN EDITING DATA
            var bio_data = $(".bio").children("p");
            var bio_id = bio_data.attr("id");
            var new_bio_id = bio_id+"-form";
            var curr_bio_val = bio_data.text();
            bio_data.empty();
            
            // send editable divs to DOM 
            $('<input type="text" name="'+new_name_id+'" id="'+new_name_id+'" value="'+curr_name_val+'" class="live-edit">').appendTo(name_data);
            $('<input type="text" name="'+new_bio_id+'" id="'+new_bio_id+'" value="'+curr_bio_val+'" class="live-edit">').appendTo(bio_data);

            // send change profile pic to DOM
            $('<input type="file" class="default-upload-btn" name="fileToUpload" id="fileToUpload" onchange="change_profile_photo(event)">').insertAfter(".profile-photo");
            $('<label id="new-upload-btn" for="fileToUpload"> <div class="camera-container"> <img class="camera-outline" src="img/camera-outline-white.png"></div></img></label>').insertAfter("#fileToUpload");

            //change btn to save profile
            $(this).attr('class', 'save-profile-btn');

            // make focus on changing name field 
            document.getElementById(new_name_id).focus();
        }
    });
    // save profile changes function
	function save_profile() {

        // Saves name for client
		var new_name_data = $(".fullname").children("h3");
        var new_name_input_id = $("#" + new_name_data.attr("id") + "-form");
		var new_name_val = new_name_input_id.val().replace(/[*^<>()|[\]\\]/g, " ");
        new_name_input_id.remove();
        new_name_data.html(new_name_val);

        // Saves description for client
        var new_bio_data = $(".bio").children("p");
		var new_bio_input_id = $("#" + new_bio_data.attr("id") + "-form");
		var new_bio_val = new_bio_input_id.val().replace(/[*^<>()|[\]\\]/g, " ");
		new_bio_input_id.remove();
        new_bio_data.html(new_bio_val);

        // Update data in database (AJAX)
        $.ajax({
            url: "php-helper/update-profile.php",
            method: "POST",
            data: {"name": new_name_val, "bio": new_bio_val},
            dataType: "json",
            success: function(data) {
                alert ("Data Save: " + data);
            }
        });
		
        $(".save-profile-btn").attr('class', 'edit-profile-btn');
        $("#fileToUpload").remove();
        $("#new-upload-btn").remove();
    };
});

function change_profile_photo(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profile_picture');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}