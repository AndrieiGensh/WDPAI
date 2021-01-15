const togglediv = document.querySelector(".toggle");

function toggleMenu()
{
    if(document.getElementById("passive"))
    {
        document.getElementById("passive").id = "active";
    }
    else
    {
        document.getElementById("active").id = "passive";
    }
}
togglediv.addEventListener("click", toggleMenu);

const exitButton = document.querySelector(".fa-door-open");
exitButton.addEventListener('click', function(event){
    document.cookie = "user_id = ; expires = Thu, 01 Jan 1970 00:00:00 GMT; path=/";
});