const submitButtons = document.querySelectorAll('.submit-button');

function clickSubmitButton(element)
{
    element.addEventListener('click', function(event){
        event.preventDefault();

        parentForm = element.parentNode;

        const file_data = new FormData();

        let fileType = '';
        let actionType = '';
        let fileTitleType = '';

        if(parentForm.name == 'PhotoForm')
        {
            fileType = "photo_image";
            fileTitleType = "photo_title";
            actionType = "addPhoto";
        }
        else
        {
            fileType = "video_file";
            fileTitleType = "video_title";
            actionType = "addVideo";
        }

        const controllerName = 'CollectionController';

        file_data.append('action', actionType);
        file_data.append(fileType, parentForm.querySelector(".select-file").files[0]);
        file_data.append(fileTitleType, parentForm.querySelector(".select-title").value);
        file_data.append('handler_controller', controllerName);

        const handlerUrl = './src/handlers/MultiHandler.php';

        const addRequest = new Request(handlerUrl, {
            method: 'POST',
            body: file_data,
            headers: new Headers()
        });

        fetch(addRequest)
            .then((responde) => responde.json())
            .then(function(answer){
                if(answer.success = 'true') {
                    alert("Successfully added photo. Still needs to be checked though ...");

                    const titleDiv = document.createElement('div');
                    titleDiv.className = 'collection-element-title';
                    titleDiv.innerHTML = parentForm.querySelector(".select-title").value;

                    let fileItself = '';
                    if (parentForm.name == "PhotoForm")
                    {
                        fileItself = document.createElement('img');
                        fileItself.src = 'public/uploads/' + parentForm.querySelector('.select-file').files[0].name;
                    }
                    else
                    {
                        fileItself = document.createElement('video');
                        fileItself.src = 'public/uploads/' + parentForm.querySelector('.select-file').files[0].name;
                    }

                    const ItemDiv = document.createElement('div');

                    if (parentForm.name == "PhotoForm")
                    {
                        ItemDiv.classList.add('photo-item');
                    }
                    else
                    {
                        ItemDiv.classList.add('video-item');
                    }
                    ItemDiv.appendChild(fileItself);
                    ItemDiv.appendChild(titleDiv);

                    parentForm.parentNode.parentNode.insertBefore(ItemDiv, parentForm);
                }
                else
                {
                    alert("File Adding failed due to " + answer.error);
                }
            });
    });
}

submitButtons.forEach(function(elem){
    clickSubmitButton(elem);
})

const memoryObjects = document.querySelectorAll('.memory-item');