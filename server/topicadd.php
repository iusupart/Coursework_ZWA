<?php
session_start();

require "../server/config.php";

/**
* Ochrana proti nepřihlášeným uživatelům, 
* která bude použita na mnoha stránkách, aby se zabránilo hackingu 
*/
if (isset($_SESSION['id']))
{

    if(isset($_POST['sub1']))
    {
        /**
         * Řízení a ochrana proti vstřikování probíhá po stisknutí tlačítka
         */
        $topicname=$_POST['topicname'];
        $textpred=$_POST['topictext'];
        $text1 = htmlspecialchars($textpred, ENT_QUOTES);
        $text2 = trim($text1);
        $id_razd=$_POST['idrazd'];
        $myid=$_SESSION['id'];

        /**
         * Pak se zkontroluje, zda je text prázdný, nebo ne.
         */
        if(!empty($topicname) && !empty($text2))
        {
            /**
             * Pokud ne, odešle se do DB 
             */
            $queryp=mysqli_query($db, "INSERT INTO `themes` (`iduser`, `razdel`, `name`, `message`, `date`) VALUES ($myid, $id_razd, '$topicname', '$text2', NOW())");
            if(isset($queryp))
            {
                header("Location:".$site_url."/modules/themeadd.php?id=$id_razd&done=1");
            } 
            /**
             * Pokud ano, neodešle se do DB 
             */
            else
            {
                header("Location:".$site_url."/modules/themeadd.php?id=$id_razd&error=1");
            }
        }
        else
        {
            header("Location:".$site_url."/modules/themeadd.php?id=$id_razd&error=1");
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