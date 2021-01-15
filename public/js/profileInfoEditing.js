const editButton = document.querySelector('.edit-about-me');
const submitEditingButton = document.querySelector('.submit-edit-about-me');
const cancelEditingButton = document.querySelector('.cancel-edit-about-me');
const editableAboutMeText = document.querySelector('.editable-about-me');
const constantAboutMeText = document.querySelector('.const-about-me');
const previousAboutMeText = constantAboutMeText.innerHTML;

editButton.addEventListener("click", function(event){
    editableAboutMeText.id = '';
    submitEditingButton.id = '';
    cancelEditingButton.id = '';

    editButton.id = 'hidden';
    constantAboutMeText.id = 'hidden';

    if((previousAboutMeText.trim()).length === 0)
    {
        editableAboutMeText.innerHTML = 'Some text to be adited';
    }
    else
    {
        editableAboutMeText.innerHTML = aboutMeContent;
    }
});

submitEditingButton.addEventListener("click", function(event){
    event.preventDefault();
    let contentToBeUpdated = editableAboutMeText.innerHTML;

    const updateForm = new FormData();
    updateForm.append('action', 'updateAboutMe');

    const handlerUrl = './src/handlers/ProfileHandler.php';

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
                constantAboutMeText.innerHTML = editableAboutMeText.innerHTML;
                constantAboutMeText.id = '';
                editableAboutMeText.id = 'hidden';

                submitEditingButton.id = 'hidden';
                cancelEditingButton.id = 'hidden';

                editButton.id = '';
            }
            else
            {
                alert("Update failed due to " + data.error);
            }
        })
});

cancelEditingButton.addEventListener("click", function(event){
    event.preventDefault();
    editableAboutMeText.innerHTML = '';

    alert("Update aborted");

    constantAboutMeText.innerHTML = previousAboutMeText;
    constantAboutMeText.id = '';
    editableAboutMeText.id = 'hidden';

    submitEditingButton.id = 'hidden';
    cancelEditingButton.id = 'hidden';

    editButton.id = '';
});