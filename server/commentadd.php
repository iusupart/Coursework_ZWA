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
     * Pomůže nám přidat komentář při stisknutí tlačítka, 
     * spustí skript, který vynutí zpracování napsaného textu a 
     * odstraní všechny speciální znaky (injekce) a odešle zprávu do databáze.
     */
    if(isset($_POST['sub3']))
    {
        if(!empty($_POST['commentadd']))
        {
            $commentpred=$_POST['commentadd'];
            $comment1 = htmlspecialchars($commentpred, ENT_QUOTES);
            $comment2 = trim($comment1);
            $id_user=$_SESSION['id'];
            $id_theme=$_POST['idtheme'];

            $queryo=mysqli_query($db, "INSERT INTO `comments` (`topicid`, `userid`, `commenttext`) VALUES ($id_theme, $id_user, '$comment2')");

            /**
             * Pokud se něco pokazí, zobrazí se chyba.
             */
            if($queryo)
            {
                header("Location:".$site_url."/modules/themeshow.php?id=$id_theme&pageno=1");
            }
            else
            {
                header("Location:".$site_url."/modules/themeshow.php?id=$id_theme&emf=2");
            }
        }
        else
        {
            $id_theme=$_POST['idtheme'];
            header("Location:".$site_url."/modules/themeshow.php?id=$id_theme&emf=1");
        }

    }
    else 
    {
        header("Location:".$site_url);
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