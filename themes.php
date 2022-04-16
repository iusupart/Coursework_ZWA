<?php
session_start();
/**
 * Tento skript pomáhá zapamatovat si, 
 * které téma osoba použila na domovské obrazovce. 
 */
if(isset($_GET["theme"]))
{
    $theme = $_GET["theme"];

    if($theme == "light" || $theme == "dark")
    {
   	 $_SESSION["theme"] = $theme;
    }
}
?>
