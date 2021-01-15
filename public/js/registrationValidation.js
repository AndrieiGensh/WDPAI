const registrationForm = document.querySelector(".registration-form");

const userNameField = registrationForm.querySelector('input[name="new_user_name"]');
const userSurnameField = registrationForm.querySelector('input[name="new_user_surname"]');
const userPasswordField = registrationForm.querySelector('input[name="new_user_password"]');
const userPasswordConfirm = registrationForm.querySelector('input[name="new_user_password_repeat"]');
const userEmailField = registrationForm.querySelector('input[name="new_user_email"]');

const messageField = document.querySelector(".message");

userNameField.addEventListener("change", function (){
    setTimeout(function(){
        if(userNameField.value.length <= 2)
        {
            userNameField.id = "not-valid";
        }
        else
        {
            userNameField.id = "valid";
        }
    }, 1000);
});

userSurnameField.addEventListener("change", function (){
    setTimeout(function(){
        if(userSurnameField.value.length <= 2)
        {
            userSurnameField.id = "not-valid";
        }
        else
        {
            userSurnameField.id = "valid";
        }
    }, 1000);
});

userPasswordField.addEventListener("change", function (){
    setTimeout(function(){
        if(userPasswordField.value.length <= 8)
        {
            userPasswordField.id = "not-valid";
        }
        else
        {
            userPasswordField.id = "valid";
        }
    }, 1000);
});

userPasswordConfirm.addEventListener("change", function (){
    setTimeout(function(){
        if(userPasswordConfirm.value !== userPasswordField.value)
        {
            userPasswordConfirm.id = "not-valid";
        }
        else
        {
            userPasswordConfirm.id = "valid";
        }
    }, 1000);
});

userEmailField.addEventListener("change", function (){
    setTimeout(function(){
        alert(userEmailField.value);
        if(/\S+@\S+\.\S+/.test(userEmailField.value))
        {
            userEmailField.id = "valid";
        }
        else
        {
            userEmailField.id = "not-valid";
        }
    }, 1000);
});

const submitButton = document.querySelector(".submit-registration-btn");
submitButton.addEventListener("click", function(event){
    event.preventDefault();
    let validFields = 0;

    if(userNameField.id === "valid")
    {
        validFields += 1;
    }
    if(userSurnameField.id === "valid")
    {
        validFields += 1;
    }
    if(userPasswordField.id === "valid")
    {
        validFields += 1;
    }
    if(userPasswordConfirm.id === "valid")
    {
        validFields += 1;
    }
    if(userEmailField.id === "valid")
    {
        validFields += 1;
    }

    alert(validFields);

    if(validFields === 5)
    {
        alert("All fields are valid");
        const formData = new FormData();
        formData.append("action", "addNewUser");
        formData.append("name", userNameField.value);
        formData.append("surname", userSurnameField.value);
        formData.append("email", userEmailField.value);
        formData.append("password", userPasswordField.value);

        const handlerUrl = './src/handlers/RegistrationHandler.php';

        const request = new Request(handlerUrl, {
            method: 'POST',
            body: formData,
            headers: new Headers()
        });
        alert("Sending adding request");
        fetch(request)
            .then((result) => result.json())
            .then(function(data){
                alert("we are checking the response");
                if(data.success === 'true')
                {
                    alert("Successfully added user.");

                    const actionRequest = new FormData();
                    actionRequest.append("action", "redirectNewUser");
                    actionRequest.append('created_user_email', userEmailField.value);

                    const successRequest = new Request(handlerUrl, {
                        method: 'POST',
                        body: actionRequest,
                        headers: new Headers()
                    });
                    alert("Sending redirection request");
                    fetch(successRequest)
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(answer){
                            if(answer.success === 'true')
                            {
                                let now = new Date();
                                let time = now.getTime();
                                time += 3600 * 1000;
                                now.setTime(time);
                                alert('url = ' + answer.url);
                                alert('user id' + answer.user_id);
                                document.cookie = "user_id=" + answer.user_id + '; expires' + now.toUTCString() + '; path=/';
                                window.location.replace(answer.url);
                            }
                        });
                }
                else
                {
                    if(data.error === 'EmailOccupied')
                    {
                        messageField.innerHTML = "The user with this email already exists";
                    }
                    else
                    {
                        alert("Failed due to " + data.error);
                    }
                }
            });
    }
});

const cancelButton = document.querySelector(".cancel-registration-btn");
cancelButton.addEventListener("click", function(event){
    event.preventDefault();
    const handlerUrl = './src/handlers/RegistrationHandler.php';
    alert("inside the cancel bytton");
    const actionForm = new FormData();
    actionForm.append("action", "getUrlForCancelButton");
    const cancelRequest = new Request(handlerUrl, {
        method: 'POST',
        body: actionForm,
        headers: new Headers()
    });

    alert("BEfore fetch");

    fetch(cancelRequest)
        .then(function(responde){
            alert("in first then");
            return responde.json();
        })
        .then(function(data){
            alert(data);
            alert("URL = " + data.url);
            if(data.success === 'true')
            {
                alert("Success");
                document.cookie = "user_id = ; expires = Thu, 01 Jan 1970 00:00:00 GMT; path=/";
                window.location.replace(data.url);
            }
            else
            {
                alert("Could not retrieve url from the controller");
            }
        })
        .catch((error) => {
            alert('Error');
            console.log(error);
        })
});
