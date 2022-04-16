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
     * Skript pro administrátory - když administrátor klikne na tlačítko odstranit uživatele`, 
     * je přesměrován na jiný odkaz, kde bude komentář odstraněn podle ID komentáře zadaného v metodě GET a 
     * přenese administrátora zpět na stránku tématu.
     */
   $id_u=$_GET['id_u'];
   $id_t=$_GET['id_t'];
   $id_th=$_GET['th_b'];

   $query_delet=mysqli_query($db, "DELETE FROM `users` WHERE ((`id` = $id_u))");

   $query_check=mysqli_query($db, "SELECT * FROM `dopinf` WHERE `id_user`='$id_u'"); 

   /**
    * Pokud uživatel přidal informace o sobě, 
    * musí být také odstraněny (je třeba zkontrolovat, zda jsou informace o tomto uživateli v databázi).
    */

   if(isset($query_check))
   {
    $query_delet_dop=mysqli_query($db, "DELETE FROM `dopinf` WHERE ((`id_user` = $id_u))");
   }

   else
   {

   }

   $query_check_dopcom=mysqli_query($db, "SELECT * FROM `comments` WHERE `userid`='$id_u'"); 

    /**
    * Pokud uživatel napsal nějaké další komentáře, 
    * musí být také odstraněny (je třeba zkontrolovat, zda jsou informace o tomto uživateli v databázi).
    */

   if(isset($query_check_dopcom))
   {
    $query_delet_dopcom=mysqli_query($db, "DELETE FROM `comments` WHERE ((`userid` = $id_u))");
   }

   else
   {

   }

   /**
    * Pokud uživatel napsal nějaké další diskuse, 
    * musí být také odstraněny (je třeba zkontrolovat, zda jsou informace o tomto uživateli v databázi).
    */

   $query_check_topic=mysqli_query($db, "SELECT * FROM `themes` WHERE `iduser`='$id_u'");

   if(isset($query_check_topic))
   {
    $query_delet_dopcom_top=mysqli_query($db, "DELETE FROM `themes` WHERE ((`iduser` = $id_u))");
   }

   else
   {

   }

   header("Location:".$site_url."/modules/themes.php?id=".$id_th);
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