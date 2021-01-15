
let titleField = document.querySelector(".select-photo-title");
titleField.addEventListener("keyup", function() {
    var content = document.forms["UploadForm"]["photo-title"].value;
    if(content != "" && content != null)
    {
        if(document.querySelector(".select-photo").files.length != 0) {
            document.querySelector(".submit-button").disabled = false;
        }
    }
    else {
        document.querySelector(".submit-button").disabled = true;
    }
});

let realFileInput = document.querySelector(".select-photo");
let fileInputReplacement = document.querySelector(".replacement");
fileInputReplacement.addEventListener("click", function(){
    $(".select-photo").trigger("click");
});
