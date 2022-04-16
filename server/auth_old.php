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
      <title>PŘIHLÁŠENÍ</title>
      <link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
      <link href="../style/auth-e-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">      
    </head>
    <body>
    <?php
         $login=trim(htmlspecialchars($_POST['login']));
         $password=trim(htmlspecialchars($_POST['password']));

        /**
         * Pot5ebujeme to pro ověřování HASHu a našeho passwordu, který jsme dostali od formuláře
         */
          $query=mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login'");
          print "lol";
          if(isset($query))
          {
          $query_v=mysqli_fetch_assoc($query);
          $hash=$query_v['password'];
          }
          else 
          {
            
          }
          /**
           *  pokud se shodují - osoba se může přihlásit. pokud se údaje neshodují - osoba se nemůže přihlásit.
           */
          if((mysqli_num_rows($query)>0) && password_verify($password, $hash))
          {
              
              $id=$query_v['id'];
              $_SESSION['id']=$id;
              // header("Location:".$site_url."/modules/auth.php?res=1");

              ?><div class="con1"><span class="con2"><?php
              print "VY JSTE BYL PŘIHLÁŠEN(-A)<br /><br />";
              /**
          * Funkce pro přidání návštěv do DB, aby se později zobrazily v databázi 
          */
              print "<a href=".$site_url.">HLAVNÍ STRÁNKA</a><br /><br />";
              print "<a href=".$site_url."/modules/home.php>FÓRUM</a>";
              ?></span></div><?php
          }      
          else 
          {
              ?><div class="con1"><span class="con2"><?php
              print "Heslo nebo jmeno není správné, zkuste<br />";
        //       /**
        //   * Funkce pro přidání návštěv do DB, aby se později zobrazily v databázi 
        //   */
              print "<a href=".$site_url."/modules/auth.php?id=".$login.">Ještě jednou</a>";
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