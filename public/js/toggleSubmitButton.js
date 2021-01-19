const fileTitleFields = document.querySelectorAll('.select-title');
const fileSelectionReplacements = document.querySelectorAll('.replacement');

function typeFileTitle(element)
{
    element.addEventListener("keyup", function(event){
        event.preventDefault();
        fileForm = element.parentNode;

        const content = element.value;
        if(content != "" && content != null)
        {
            if(fileForm.querySelector('.select-file').files.length != 0) {
                fileForm.querySelector('.submit-button').disabled = false;
            }
        }
        else {
            fileForm.querySelector(".submit-button").disabled = true;
        }
    });
}

function selectFile(element)
{
    element.addEventListener("click", function(event){
        event.preventDefault();
        fileForm = element.parentNode;

        fileForm.querySelector('.select-file').click();
    });
}

fileTitleFields.forEach(function(elem){
    typeFileTitle(elem);
});

fileSelectionReplacements.forEach(function(elem){
    selectFile(elem);
});
