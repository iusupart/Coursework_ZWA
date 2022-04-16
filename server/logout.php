<?php 
session_start();

require "../server/config.php";
/**
* Ochrana proti nepřihlášeným uživatelům, 
* která bude použita na mnoha stránkách, aby se zabránilo hackingu 
*/
if (isset($_SESSION['id']))
{
  /**
   * Odhlásí se vymazáním souboru cookie a ukončením relace. 
   */
    unset($_SESSION['login']);
    unset($_SESSION['id']);
    session_unset();
  session_destroy();
  header("Location:".$site_url);

}
/**
* Ochrana proti nepřihlášeným uživatelům, 
* která bude použita na mnoha stránkách, aby se zabránilo hackingu 
*/
else 
{
    header("location:".$site_url."/modules/auth.php");
} 