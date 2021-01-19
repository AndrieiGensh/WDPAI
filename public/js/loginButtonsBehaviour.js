const loginAsGuestButton = document.querySelector('.login-as-guest');
const registerButton = document.querySelector('.create-account');

loginAsGuestButton.addEventListener('click', function(event){
    event.preventDefault()
    let now = new Date();
    let time = now.getTime();
    time += 3600 * 1000;
    now.setTime(time);
    document.cookie = "user_id=0; expires" + now.toUTCString() + '; path=/';
    window.location.replace("http://localhost:8080/profile");
});

registerButton.addEventListener('click', function(event){
    event.preventDefault();
    window.location.replace("http://localhost:8080/registration");
});