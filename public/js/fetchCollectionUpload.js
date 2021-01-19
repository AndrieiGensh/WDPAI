const submitButtons = document.querySelectorAll('.submit-button');

function clickSubmitButton(element)
{
    element.addEventListener('click', function(event){
        event.preventDefault();

        getPermission('add_permission').then(function(data){
            if(data === 'null')
            {
                alert("Could not retrieve permissions");
                return;
            }
            else
            {
                if(data === 'false')
                {
                    alert("Permision denied");
                    return;
                }
                else
                {
                    alert('Permission granted');

                    parentForm = element.parentNode;

                    const file_data = new FormData();

                    let fileType = '';
                    let actionType = '';
                    let fileTitleType = '';
                    let file_id = 'file_id';
                    let controllerName = 'CollectionController';

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

                    file_data.append('action', actionType);
                    file_data.append(fileType, parentForm.querySelector(".select-file").files[0]);
                    file_data.append(file_id, 'new');
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

                                parentForm.parentNode.parentNode.insertBefore(ItemDiv, parentForm.parentNode);
                            }
                            else
                            {
                                alert("File Adding failed due to " + answer.error);
                            }
                        });
                }
            }
        });

    });
}

submitButtons.forEach(function(elem){
    clickSubmitButton(elem);
});

const memoryObjects = document.querySelectorAll('.memory-item');

function clickOnMemory(elem)
{
    elem.addEventListener('click', function(event){
        event.preventDefault();
        document.querySelector(".memory-edit-div").id = "";
        if(elem.id !== 'new')
        {
            document.querySelector(".memory-placeholder").innerHTML = elem.innerHTML;
            document.querySelector('.memory-delete-button').disabled = false;
        }
        else
        {
            document.querySelector(".memory-placeholder").innerHTML = '';
            document.querySelector('.memory-delete-button').disabled = true;
        }
        document.querySelector(".memory-editor-area").id = elem.id;
    })
}

memoryObjects.forEach(function(elem){
    clickOnMemory(elem);
});

const memoryEditor = document.querySelector(".memory-edit-div");
const memoryEditSubmitButton = memoryEditor.querySelector('.memory-edit-submit-button');
const memoryEditCancelButton = memoryEditor.querySelector('.memory-edit-cancel-button');
const memoryDeleteButton = document.querySelector(".memory-delete-button");
const memoryEditButton = memoryEditor.querySelector('.memory-edit-button');
const memoryTextArea = memoryEditor.querySelector('.memory-text');

let previousContent = memoryEditor.querySelector(".memory-placeholder").innerHTML.trim();

memoryEditButton.addEventListener("click", function(event){
    event.preventDefault();

    getPermission('edit_permission').then(function(data){
        if(data === 'null')
        {
            alert("Could not retrieve permissions");
            return;
        }
        else
        {
            if(data === 'false')
            {
                alert("Permision denied");
                return;
            }
            else
            {
                alert('Permission granted');

                memoryEditSubmitButton.id = '';
                memoryEditCancelButton.id = '';
                memoryDeleteButton.id = '';
                memoryTextArea.id = '';

                previousContent = memoryEditor.querySelector(".memory-placeholder").innerHTML.trim();
                memoryEditor.querySelector(".memory-placeholder").id = 'hidden';

                memoryTextArea.value = previousContent;

                memoryEditButton.id = 'hidden';
            }
        }
    });

});

memoryEditCancelButton.addEventListener("click", function(event){
    event.preventDefault();

    memoryEditButton.id = '';
    memoryEditSubmitButton.id = 'hidden';
    memoryEditCancelButton.id = 'hidden';
    memoryDeleteButton.id = 'hidden';
    memoryTextArea.id = 'hidden';

    memoryEditor.querySelector(".memory-placeholder").innerHTML = previousContent;
    memoryEditor.querySelector(".memory-placeholder").id = '';
});

memoryEditSubmitButton.addEventListener("click", function(event){
    event.preventDefault();

    let contentToBeUpdated = memoryTextArea.value;
    const handlerUrl = './src/handlers/MultiHandler.php';

    const updateData = new FormData();
    updateData.append("action", "addMemory");
    updateData.append("memory_id", memoryEditor.querySelector('.memory-editor-area').id);
    updateData.append('memory_content', contentToBeUpdated);
    updateData.append("memory_title", 'memoryTitle');
    updateData.append('handler_controller', 'CollectionController');

    const updateRequest = new Request(handlerUrl, {
        method: 'POST',
        body: updateData,
        headers: new Headers()
    });

    fetch(updateRequest)
        .then((responde) => responde.json())
        .then(function(data){
            if(data.success == 'true')
            {
                if(data.memory_id != memoryEditor.querySelector('.memory-editor-area').id)
                {
                    const memoryElement = document.createElement('div');
                    memoryElement.className = 'memory-item';
                    memoryElement.id = data.memory_id;

                    memoryElement.innerHTML = memoryTextArea.value;
                    const addNewMemoryButton = document.querySelector('.collection-memories').querySelector("#new");
                    addNewMemoryButton.parentNode.insertBefore(memoryElement, addNewMemoryButton);

                    memoryEditButton.id = '';
                    memoryEditSubmitButton.id = 'hidden';
                    memoryEditCancelButton.id = 'hidden';
                    memoryDeleteButton.id = 'hidden';
                    memoryTextArea.id = 'hidden';
                    memoryEditor.querySelector(".memory-placeholder").id = '';
                    memoryEditor.querySelector('.memory-editor-area').id = '';
                    memoryEditor.id = 'hidden';
                }
                else
                {
                    const memoryElements = document.querySelectorAll('.memory-item');
                    let memoryItem = '';
                    memoryElements.forEach(function(memory){
                        if(memory.id == data.memory_id)
                        {
                            memoryItem = memory;
                            return;
                        }
                    });
                    memoryEditButton.id = '';
                    memoryEditSubmitButton.id = 'hidden';
                    memoryEditCancelButton.id = 'hidden';
                    memoryTextArea.id = 'hidden';
                    memoryDeleteButton.id = 'hidden';
                    memoryEditor.querySelector(".memory-placeholder").id = '';
                    memoryEditor.querySelector('.memory-editor-area').id = '';
                    memoryEditor.id = 'hidden';

                    memoryItem.innerHTML = memoryTextArea.value;
                }
            }
            else
            {
                alert("Update failed due to " + data.error);
            }
        });
});

memoryDeleteButton.addEventListener("click", function(event){
    getPermission('delete_permission').then(function(data){
        if(data === 'null')
        {
            alert("Could not retrieve permissions");
            return;
        }
        else
        {
            if(data === false)
            {
                alert("Permision denied");
                return;
            }
            else
            {
                alert('Permission granted');
                const deleteForm = new FormData();
                deleteForm.append('action', 'deleteMemory');
                deleteForm.append('memory_id', memoryEditor.querySelector('.memory-editor-area').id);
                deleteForm.append('handler_controller', 'CollectionController');

                const handlerUrl = './src/handlers/MultiHandler.php';

                const deleteRequest = new Request(handlerUrl,{
                    method: 'POST',
                    body: deleteForm,
                    headers: new Headers()
                });

                fetch(deleteRequest)
                    .then((responde) => responde.json())
                    .then(function(data){
                        if(data.success == 'true')
                        {
                            alert("memory deleted successfully");
                            const memoryElements = document.querySelectorAll('.memory-item');
                            let memoryItem = '';
                            memoryElements.forEach(function(memory){
                                if(memory.id == memoryEditor.querySelector('.memory-editor-area').id)
                                {
                                    memoryItem = memory;
                                    return;
                                }
                            });
                            memoryItem.remove();

                            memoryEditButton.id = '';
                            memoryEditSubmitButton.id = 'hidden';
                            memoryEditCancelButton.id = 'hidden';
                            memoryTextArea.id = 'hidden';
                            memoryDeleteButton.id = 'hidden';
                            memoryEditor.querySelector(".memory-placeholder").id = '';
                            memoryEditor.querySelector('.memory-editor-area').id = '';
                            memoryEditor.id = 'hidden';
                        }
                        else
                        {
                            alert("Could not delete memory due to " + data.error);
                        }
                    });
            }
        }
    });
});

memoryEditor.addEventListener("click", function(event){
    event.preventDefault();

    if(event.target !== event.currentTarget)
    {
        return;
    }
    else
    {
        memoryEditCancelButton.click();
        memoryEditor.id = 'hidden';
        document.querySelector(".memory-editor-area").id = '';
    }
});
