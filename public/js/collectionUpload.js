$(document).ready(function() {
    $('.add-photo').submit(function(event) {
        var ajaxRequest;

        event.preventDefault();

        var form_data = new FormData();
        var file_data = $('.select-photo').prop('files')[0];
        var file_title = $('input[name="photo-title"]').val();

        form_data.append("action", "addPhoto");
        form_data.append('photo_title', file_title);
        form_data.append('photo_image', file_data);
        alert("file title = " + file_title);
        ajaxRequest = $.ajax(
            {
                url: './src/controllers/CollectionController.php',
                type: "post",
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'json'
            });
        alert("after ajax");
        ajaxRequest.done(function(result) {
            alert(result["error"] + " " + result["success"])
            if(result["success"] == "true")
            {
                alert("Successfully added photo. Still needs to be checked though ...");
            }
            else
            {
                alert("Adding failed due to " + result["error"]);
            }
        });
    });
})