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
                // exit('lol');
                header("Location:".$site_url."/modules/reg.php?id=".$login."&mail=".$email."&res=1");
              }
              /**
               * Kontrola toho, zda jsou nejen písmena v "loginu"
               */
              elseif(preg_match('/[^A-Za-z]/', $login))
              {
                header("Location:".$site_url."/modules/reg.php?mail=".$email."&res=2");
              }
              /**
               * Pokud je vše v pořádku, data se odešlou do databáze. 
               */
              else
              {
                  $query3=mysqli_query($db, "INSERT INTO `users` (`login`, `email`, `password`)
                  VALUES('$login', '$email', '$password')");
                  header("Location:".$site_url."/modules/reg.php?id_a=".$login."&res=3");
                  if(!$query4)
                  {
                    header("Location:".$site_url."/modules/reg.php?id=".$login."&mail=".$email."&res=4");
                  }
    
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