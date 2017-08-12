//Function for showing the image preview
function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
    //USED if the size of the image is Valid
function return_bytes(val) { //2M
    var val_len = val.length;
    var bytes = val.substr(0, val_len - 1); // "2"
    var last = val[val_len - 1].toLowerCase(); // "M"
    switch(last) {
        // The 'G' modifier is available since PHP 5.1.0
        case "g":
            bytes *= (1024 * 1024 * 1024); //1073741824
            break;
        case "m":
            bytes *= (1024 * 1024); //1048576    
            break;
        case "k":
            bytes *= 1024;
            break;
    }
  
    return bytes;
}

//Form validation
function validateForm() {  
    var return_value = true;
    var error = "";
    document.getElementById("error").innerHTML = "";

    /************************/
    /*  IMG FILE VALIDATION  /
    /************************/ 
    var input = document.getElementById('fileToUpload');
    var image =  input.value;
    var file = input.files[0];

    //Uploaded file MUST be an Image
    var dotIndex = image.lastIndexOf('.');
    var ext = (image.substring(dotIndex).toLowerCase());
    if ((ext != ".jpg") && (ext != ".jpeg") && (ext != ".png") && (ext != ".gif")) {
        error += "<br>Upload a valid image file.";
        return_value = false;
    }

    //IF image size is bigger than maximum possible size
    var bytes = return_bytes("<?php echo ini_get('upload_max_filesize')?>");
    var upload_max_filesize = bytes;
    if (file && file.size > upload_max_filesize) {
        error += "<br>File is too large. Must be 2MB or less.";
        return_value = false;
    }

    /************************/
    /*    Input VALIDATION   /
    /************************/

    //NAME VALIDATION 
    var event_name = document.getElementById('event-name').value;
    if (event_name.length > 50) {
        error += "<br>Event Name is too long.";
        return_value = false;
    }

    //LOCATION VALIDATION
    var location = document.getElementById('location').value;
    if (location.length > 100) {
        error += "<br>Location is too long.";
        return_value = false;
    }

    //START DATE & TIME VALIDATION
    var today = new Date();
    var current_year = today.getFullYear();
    var current_month = today.getMonth() + 1;
    var current_day = today.getDate();
    var current_time = today.getHours();

    var date_start = document.getElementById('date-start').value;
    var time_start = document.getElementById('time-start').value;
    var start_date = date_start.split("-");
    var hour = time_start.split(":");

    var same_year = (start_date[0] == current_year );
    var same_month = (start_date[1] == current_month);
    var same_day = (start_date[2] == current_day);


    if (start_date[0] > current_year + 2) {
        error += "<br>Start date should be within 2 years from now.";
        return_value = false;
    } 
    
    if (start_date[0] < current_year) {
        error += "<br>Start date Year already passed.";
        return_value = false;
    } 

    if (same_year) {
        if (start_date[1] < current_month) {
            error += "<br>Start date Month already passed.";
            return_value = false;
        }    

        if (same_month){
            if (start_date[2] < current_day) {
                    error += "<br>Start date Day already passed.";
                    return_value = false;
            }
            if (same_day) {
                if (parseInt(s) + 1 <= current_time) {
                    error += "<br>Start Time is too soon or has already passed.";
                    return_value = false;
                }
            }
        }         
    }

    //End DATE & TIME VALIDATION
    var date_end = document.getElementById('date-end').value;
    var time_end = document.getElementById('time-end').value;
    var end_date = date_end.split("-");
    var end_hour = time_start.split(":");

    var same_year = (start_date[0] == end_date[0]);
    var same_month = (start_date[1] == end_date[1]);
    var same_day = (start_date[2] == end_date[2]);

    if (end_date[0] < start_date[0]) {
        error += "<br>End date Year is invalid.";
        return_value = false;
    }

    if (end_date[0] > parseInt(start_date[0]) + 2) {
        alert(end_date[0] + " " + start_date[0])
        error += "<br>End date is too far in the future.";
        return_value = false;
    } 

    if (same_year) {
        if (end_date[1] < start_date[1]) {
            error += "<br>End date Month is invalid.";
            return_value = false;
        }

        if (same_month) {
            if (end_date[2] < start_date[2]) {
                error += "<br>End date Day is invalid.";
                return_value = false;   
            }

            if (same_day) {
                if (end_hour[0] + 1 <= hour[0] + 1) {
                    error += "<br>Start Time is too soon or has already passed.";
                    return_value = false;
                }
            }              
        }
    }

    //DESCRIPTION VALIDATION
    var description = document.getElementById('description').value;
    if (description.length > 500) {
        error += "<br>Description is too long.";
        return_value = false;
    }

    document.getElementById("error").innerHTML  = error;

    //Makes the page go back up when there's an input error
    if (!return_value) {
        $('html, body').animate({ scrollTop: 0 }, 'fast');
    }

    return return_value;

    // jQuery(function($) {
    //     $('#event-image').Jcrop();
    // });

    //alert(file.name + " " + file.size + " " + upload_max_filesize);
}