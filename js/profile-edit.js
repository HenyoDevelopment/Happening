$(document).ready(function() {
	$(".edit-profile-btn").on("click", function(e) {
        if ($(".save-profile-btn")[0]){
            save_profile();
        } else {
            //edit name
            var name_data = $(".fullname").children("h3");
            var name_id = name_data.attr("id");
            var new_name_id = name_id+"-form";
            var curr_name_val = name_data.text();
            name_data.empty();

            //edit data
            var bio_data = $(".bio").children("p");
            var bio_id = bio_data.attr("id");
            var new_bio_id = bio_id+"-form";
            var curr_bio_val = bio_data.text();
            bio_data.empty();
            
            // editable divs to DOM 
            $('<input type="text" name="'+new_name_id+'" id="'+new_name_id+'" value="'+curr_name_val+'" class="live-edit">').appendTo(name_data);
            $('<input type="text" name="'+new_bio_id+'" id="'+new_bio_id+'" value="'+curr_bio_val+'" class="live-edit">').appendTo(bio_data);

            // change profile pic to DOM
            $('<input type="file" class="default-upload-btn" name="fileToUpload" id="fileToUpload" onchange="change_profile_photo(event)">').insertAfter(".profile-photo");
            $('<label id="new-upload-btn" for="fileToUpload">Choose a file</label>').insertAfter("#fileToUpload");

            //change btn to save profile
            $(this).attr('class', 'save-profile-btn');
        }
    });
    // save profile changes function
	function save_profile() {
        // save name
		var name_data = $(".fullname").children("h3");
		var new_name_id   = name_data.attr("id");
		var c_name_input  = "#"+new_name_id+"-form";
		var e_name_input  = $(c_name_input);
		var new_name_val  = e_name_input.val();
		e_name_input.remove();
        name_data.html(new_name_val);
        
        // save description
        var bio_data = $(".bio").children("p");
		var new_bio_id   = bio_data.attr("id");
		var c_bio_input  = "#"+new_bio_id+"-form";
		var e_bio_input  = $(c_bio_input);
		var new_bio_val  = e_bio_input.val();
		e_bio_input.remove();
		bio_data.html(new_bio_val);
		
        $(".save-profile-btn").attr('class', 'edit-profile-btn');
        $("#fileToUpload").remove();
        $("#new-upload-btn").remove();
    };
});

function change_profile_photo(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profile-photo');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}