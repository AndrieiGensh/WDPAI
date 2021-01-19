const editButtons = document.querySelectorAll('.edit-button');
const submitEditingButtons = document.querySelectorAll('.submit-edit-button');
const cancelEditingButtons = document.querySelectorAll('.cancel-edit-button');


function editButtonClick(element)
{
    element.addEventListener("click", function(event){

        getPermission('edit_permission').then(function(data){
            alert(data);
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

                    grandparent = element.parentNode.parentNode;
                    event.preventDefault();
                    grandparent.querySelector('.edit-button').id = 'hidden';

                    const editableField = grandparent.querySelector('.editable-info');
                    editableField.id = '';
                    grandparent.querySelector('.submit-edit-button').id = '';
                    grandparent.querySelector('.cancel-edit-button').id = '';

                    const constInfo = grandparent.querySelector('.const-info');
                    constInfo.id = 'hidden';

                    if((constInfo.innerHTML.trim()).length === 0)
                    {
                        editableField.value = 'Some text to be adited';
                    }
                    else
                    {
                        editableField.value = constInfo.innerHTML.trim();
                    }
                }
            }
        });

    });
}

function cancelButtonClick(element)
{
    element.addEventListener("click", function(event){
        event.preventDefault();
        grandparent = element.parentNode.parentNode;
        const editableField = grandparent.querySelector('.editable-info');
        editableField.id = 'hidden';
        editableField.value = '';
        grandparent.querySelector('.submit-edit-button').id = 'hidden';
        grandparent.querySelector('.cancel-edit-button').id = 'hidden';

        const constInfo = grandparent.querySelector('.const-info');
        constInfo.id = '';

        grandparent.querySelector('.edit-button').id = '';
    });
}

function submitButtonClick(element)
{
    element.addEventListener("click", function(event){
        event.preventDefault();

        getPermission('add_permission').then(function(data){
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

                    grandparent = element.parentNode.parentNode;
                    let contentToBeUpdated = grandparent.querySelector('.editable-info').value;

                    const updateForm = new FormData();
                    if(grandparent.querySelector('.const-info').getAttribute("name") == 'about-me')
                    {
                        updateForm.append('action', 'updateAboutMe');
                        updateForm.append('newAboutMe', contentToBeUpdated);
                    }
                    else
                    {
                        updateForm.append('action', 'updateTravellersCode');
                        updateForm.append('code', contentToBeUpdated);
                    }
                    updateForm.append('handler_controller', 'ProfileController');

                    const handlerUrl = './src/handlers/MultiHandler.php';

                    const updateRequest = new Request(handlerUrl, {
                        method: 'POST',
                        body: updateForm,
                        headers: new Headers()
                    });

                    fetch(updateRequest)
                        .then((responde) => responde.json())
                        .then(function(data){
                            if(data.success === 'true')
                            {
                                alert("Update has been a success");
                                grandparent.querySelector('.const-info').innerHTML = contentToBeUpdated;
                                grandparent.querySelector('.const-info').id = '';
                                grandparent.querySelector('.editable-info').id = 'hidden';

                                grandparent.querySelector('.submit-edit-button').id = 'hidden';
                                grandparent.querySelector('.cancel-edit-button').id = 'hidden';

                                grandparent.querySelector('.edit-button').id = '';
                            }
                            else
                            {
                                alert("Update failed due to " + data.error);
                            }
                        });
                }
            }
        });
    });
}

editButtons.forEach(function(elem){
    editButtonClick(elem);
});

cancelEditingButtons.forEach(function(elem){
    cancelButtonClick(elem);
});

submitEditingButtons.forEach(function(elem){
    submitButtonClick(elem);
});