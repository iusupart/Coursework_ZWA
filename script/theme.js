// BUTTON VARIADBLE AND LINK VARIABLE 
var btn = document.getElementById("button");
var link = document.getElementById("theme-link");

btn.addEventListener("click", function () { ChangeTheme(); });

function ChangeTheme()
{
    // SET THEME VARIABLE 
    let lightTheme = "style/indexstyle-light.css";
    let darkTheme = "style/indexstyle-dark.css";

    var currTheme = link.getAttribute("href");
    var theme = "";
    // COMPARE 
    if(currTheme == lightTheme)
    {
   	 currTheme = darkTheme;
   	 theme = "dark";
    }
    else
    {    
   	 currTheme = lightTheme;
   	 theme = "light";
    }

    link.setAttribute("href", currTheme);

    // Accessing PHP 

        var Request = new XMLHttpRequest();
        Request.open("GET", "/~iusupart/themes.php?theme=" + theme, true);
        Request.send();
}