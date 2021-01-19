const deleteAccountButton = document.querySelector(".delete-account-button");
deleteAccountButton.addEventListener("click", function(event){
    event.preventDefault();

    getPermission('delete_permission').then(function(data) {
        alert(data);
        if (data === 'null') {
            alert("Could not retrieve permissions");
            return;
        } else {
            if (data === 'false') {
                alert("Permision denied");
                return;
            } else {
                alert('Permission granted');
                const handlerUrl = './src/handlers/MultiHandler.php';
                const deleteForm = new FormData();
                deleteForm.append("action", 'deleteUsersAccount');
                deleteForm.append('handler_controller', 'SettingsController');

                const deleteRequest = new Request(handlerUrl, {
                    method: 'POST',
                    body: deleteForm,
                    headers: new Headers()
                });

                fetch(deleteRequest)
                    .then((responde) => responde.json())
                    .then(function(data){
                        if(data.success == 'true')
                        {
                            alert('Account deleted successfully');
                            document.cookie = "user_id = ; expires = Thu, 01 Jan 1970 00:00:00 GMT; path=/";
                            window.location.replace(data.url);
                        }
                        else
                        {
                            alert("Account Deleting failed due to " + data.error);
                        }
                    });
            }
        }
    });
})