function validate() {
    // Skript kontroluje, zda jsou k dispozici data - pokud nejsou k dispozici, vytvoří se kolem vstupního pole červený rá
    // Pokud je to správně, skript umožňuje odeslat vše na server.
    var userName = document.getElementById("login");
    var userPassword = document.getElementById("password");
    var userEmail = document.getElementById("email");


    if(!userName.value) {
      userName.style.border = "2px solid red";
      return false;
    }

    if(!userPassword.value) {
      userPassword.style.border = "2px solid red";
      return false;
    }

    if(!userEmail.value) {
        userEmail.style.border = "2px solid red";
        return false;
      }


    return true;


  }
