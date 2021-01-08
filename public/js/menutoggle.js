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