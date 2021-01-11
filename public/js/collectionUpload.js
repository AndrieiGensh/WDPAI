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
                url: './src/handlers/UploadHandler.php',
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
                var titleDiv = document.createElement('div');
                titleDiv.className = 'collection-element-title';
                titleDiv.innerHTML = file_title;

                var photoImg = document.createElement('img');
                photoImg.src = 'public/uploads/'+file_data.name;

                var photoItemDiv = document.createElement('div');
                photoItemDiv.classList.add('photo-item');
                photoItemDiv.appendChild(photoImg);
                photoItemDiv.appendChild(titleDiv);

                var uploadForm = document.querySelector('.add-photo-form');
                uploadForm.parentNode.insertBefore(photoItemDiv, uploadForm);

            }
            else
            {
                alert("Adding failed due to " + result["error"]);
            }
        });
        ajaxRequest.fail(function( result, jqXHR, textStatus){
            alert("failed due to " + textStatus + " " + jqXHR);
        });

        ajaxRequest.always(function(){
            alert("completed");
            $(".select-photo").val(null);
            $(".select-photo-title").val(null);
        });
    });

});