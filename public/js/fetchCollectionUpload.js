let submitButton = document.querySelector(".submit-button");

submitButton.addEventListener("click", function(event){
    event.preventDefault();

    var newForm = new FormData();
    var fileData = document.querySelector(".select-photo").files[0];
    var fileTitle = document.querySelector(".select-photo-title").value;

    alert("in fetch script " + fileTitle);

    newForm.append("action", "addPhoto");
    newForm.append("photo_title", fileTitle);
    newForm.append("photo_image", fileData);

    var handlerUrl = './src/handlers/UploadHandler.php';

    var request = new Request(handlerUrl,{
        method: 'POST',
        body: newForm,
        headers: new Headers()
    });

    alert("before fetch");

    fetch(request)
        .then((result) => result.json())
        .then(function(data){
            alert("in then ");
            alert("data = " + data);
            if(data.success == 'true')
            {
                alert("SUCCESS");
                var titleDiv = document.createElement('div');
                titleDiv.className = 'collection-element-title';
                titleDiv.innerHTML = fileTitle;

                var photoImg = document.createElement('img');
                photoImg.src = 'public/uploads/'+fileData.name;

                var photoItemDiv = document.createElement('div');
                photoItemDiv.classList.add('photo-item');
                photoItemDiv.appendChild(photoImg);
                photoItemDiv.appendChild(titleDiv);

                var uploadForm = document.querySelector('.add-photo-form');
                uploadForm.parentNode.insertBefore(photoItemDiv, uploadForm);

                document.querySelector(".select-photo-title").value = null;
                document.querySelector(".select-photo").files = null;

            }
            else
            {
                alert("Adding failed due to " + data.error);
                document.querySelector(".select-photo-title").value = null;
                document.querySelector(".select-photo").files = null;
            }

        })
})