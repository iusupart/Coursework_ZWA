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
         $login=trim(htmlspecialchars($_POST['login']));
         $password=trim(htmlspecialchars($_POST['password']));
        /**
         * Pot5ebujeme to pro ověřování HASHu a našeho passwordu, který jsme dostali od formuláře
         */
        $query=mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$login'");
        // if(isset($query))
        // {
        // $query_v=mysqli_fetch_assoc($query);
        // $hash=$query_v['password'];
        // }
          // else 
          // {
          //   // header("Location:".$site_url."/modules/auth.php?res=1");
          // }
          /**
           *  pokud se shodují - osoba se může přihlásit. pokud se údaje neshodují - osoba se nemůže přihlásit.
           */
          if(mysqli_num_rows($query)>0)
          {   
            $query_v=mysqli_fetch_assoc($query);
            $hash=$query_v['password'];

            if(password_verify($password, $hash))
            { 
              $id=$query_v['id'];
              $_SESSION['id']=$id;
              header("Location:".$site_url);
            }
          }      
          else 
          {
            header("Location:".$site_url."/modules/auth.php?res=1&id=".$login);
          }
         
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