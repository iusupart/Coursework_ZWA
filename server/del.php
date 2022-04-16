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
     * Skript pro administrátory - když administrátor klikne na tlačítko odstranit, 
     * je přesměrován na jiný odkaz, kde bude téma odstraněna podle ID komentáře zadaného v metodě GET a 
     * přenese administrátora zpět na stránku tématu.
     */
   $id_com=$_GET['id_com'];
   $id_theme=$_GET['id'];

   $query_delet=mysqli_query($db, "DELETE FROM `comments` WHERE ((`id` = $id_com))");

   header("Location:".$site_url."/modules/themeshow.php?id=".$id_theme."&pageon=1");
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