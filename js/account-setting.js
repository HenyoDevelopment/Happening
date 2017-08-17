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
    
    if (image) {
        if ((ext != ".jpg") && (ext != ".jpeg") && (ext != ".png") && (ext != ".gif")) {
            error += "<br>Upload a valid image file.";
            return_value = false;
        }
    }

    //IF image size is bigger than maximum possible size
    var bytes = return_bytes("<?php echo ini_get('upload_max_filesize')?>");
    var upload_max_filesize = bytes;
    if (file && file.size > upload_max_filesize) {
        error += "<br>File is too large. Must be 2MB or less.";
        return_value = false;
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
}