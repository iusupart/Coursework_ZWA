// Vezme vstupní hodnotu a zkontroluje, zda splňuje podmínku.
function check(login) {
    if ((login.length < 5) || (login.length > 15)) document.getElementById("e_login").style.display = "inline";
    else document.getElementById("e_login").style.display = "none";
  }
  function checko(login) {
    if (login.length < 7) document.getElementById("e_login_1").style.display = "inline";
    else document.getElementById("e_login_1").style.display = "none";
  }

  function checkom(login) {
    if (login.length < 1) document.getElementById("e_login_2").style.display = "inline";
    else document.getElementById("e_login_2").style.display = "none";
  }