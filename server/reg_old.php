<?php
  session_start();

  require "config.php";

  /**
   * Ochrana proti nepřihlášeným uživatelům, 
   * která bude použita na mnoha stránkách, aby se zabránilo hackingu 
   */
  
  if(!isset($_SESSION['id']))
  {
      /**
       * Po kliknutí na přihlašovací stránku 
       * se sem odešle skript a zde se zkontroluje heslo, 
       * které je zakódováno podle určitého pravidla, a také uživatelské jméno a heslo, aby se porovnaly s údaji v databázi.
       */
      if(isset($_POST['sub']))
      {
          ?>
        <!DOCTYPE html>
    <html lang="cs">
    <head>
      <title>REGISTRACE</title>
      <link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
      <link href="../style/auth-e-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">      
    </head>
    <body>
    <?php
                       /**
               * Pokud bylo stisknuto tlačítko registrace, proběhne proces kódování a 
               * opravy přijatých údajů a kontrola, zda jsou v databázi.
               */
              $email=trim(htmlspecialchars($_POST['email']));
              $login=trim(htmlspecialchars($_POST['login']));
              $password=trim(htmlspecialchars($_POST['password']));
              $password = password_hash($password, PASSWORD_DEFAULT);


              $query2=mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login'");
              $query3=mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email'");
              $query4=mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login' AND `email` = '$email'");
              /**
               * Pokud se údaje shodují s některými údaji v DB - uživatel nebude zaregistrován. 
               */
              if(mysqli_num_rows($query2)>0 || mysqli_num_rows($query3)>0)
              {
                ?><div class="con1"><span class="con2"><?php
                print "Uživatel je už zaregistrovan, zkuste <a href=".$site_url."/modules/reg.php?id=".$login."&mail=".$email.">ještě jednou</a>";
                ?></span></div><?php
              }
              /**
               * Kontrola toho, zda jsou nejen písmena v "loginu"
               */
              if(preg_match('/[^A-Za-z]/', $login))
              {
                ?><div class="con1"><span class="con2"><?php
                print "Máte špatný login, zkuste <a href=".$site_url."/modules/reg.php?mail=".$email.">ještě jednou</a>";
                ?></span></div><?php
              }
              /**
               * Pokud je vše v pořádku, data se odešlou do databáze. 
               */
              else
              {
                  $query3=mysqli_query($db, "INSERT INTO `users` (`login`, `email`, `password`)
                  VALUES('$login', '$email', '$password')");
                  ?><div class="con1"><span class="con2"><?php
                   print "Ted se muzes autorizovat, proste "?> <a class= "text-main-flex-1" href="../modules/auth.php?id=<?=$login;?>">klikni</a> <?php print "tady";
                  if(!$query4)
                  {
                      print "Něco se nepodářilo, zkuste <a href=".$site_url."/modules/reg.php?id=".$login."&mail=".$email.">ještě jednou</a>";
                  }
                  ?></span></div><?php
              }
              ?>
          </body>
          <script src="../theme.js"></script>
          </html> 
          <?php
       }
    
  }

    /**
   * Ochrana proti nepřihlášeným uživatelům, 
   * která bude použita na mnoha stránkách, aby se zabránilo hackingu 
   */
   
  else 
  {
      header("Location:".$site_url);
  }
?>