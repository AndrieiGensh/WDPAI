async function getPermission(permissionToCheck)
{
    const handlerUrl = './src/handlers/MultiHandler.php';
    const permissionForm = new FormData();
    permissionForm.append("action", 'resolvePermissions');
    permissionForm.append('handler_controller', 'SecurityController');

    const request = new Request(handlerUrl, {
        method: 'POST',
        body: permissionForm,
        headers: new Headers()
    });

    return fetch(request)
        .then((responde) => responde.json())
        .then(function(data){
            if(data.success == 'true')
            {
                return data.permissions[permissionToCheck];
            }
            return 'null';
        });
}