<?php 
session_start();

require "../server/config.php";

 /**
   * Ochrana proti nepřihlášeným uživatelům, 
   * která bude použita na mnoha stránkách, aby se zabránilo hackingu 
   */
if (isset($_SESSION['id']))
{
    ?>
     <!DOCTYPE html>
<html lang="cs">
<head>
<title>VYTVOŘENÍ TÉMATU</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
<link href="../style/home-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
<link href="../style/themewrap-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
</head>
<body>
 <div class="wrapper">
     <header class="header">
        <img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="lol">
        <a class="lb-out-back" href="<?=$site_url;?>/modules/home.php">BACK TO HOME PAGE</a>

     </header>

     <main class="content-add">
         <?php
         /**
          * Přidá novou otázku/diskuzi k tématu 
          */
            $id_razd=$_GET['id'];
            if(isset($_GET['done']))
            {
                print "Teď se můžete podívat <a href='$site_url/modules/themes.php?id=$id_razd'>se podivat</a>";
            }
           if(isset($_GET['error']))
           {
               print "Problém, zkuste ještě jednou";
           }
           
           if(isset($_GET['id']) & is_numeric($_GET['id']))
           {
               ?>
               <br />
               <h2>TEĎ MŮŽETE VYTVOŘIT OTÁZKU</h2> <br>
            <form method="POST" action="<?=$site_url;?>/server/topicadd.php">
               <input type="text" name="topicname" placeholder="NÁZEV"> <br />
               <textarea name="topictext" placeholder="TEXT"></textarea> <br />
               <input type="hidden" type="text" name="idrazd" value="<?=$id_razd;?>" >
               <input type="submit" value="Send" name="sub1">
            </form>
               <?php
           }
           /**
            * Pokud se něco nepovedlo, vyskutne se taková chyba
            */
           else
           {
               print "Zkuste ještě jednou <br>";
               print "<a href='$site_url'>Zpátky</a>";
           }
         ?>
     </main>

     </div>
 <footer class="footer">
      <span class="footer-text">ČVUT V PRAZE</span>
 </footer>
</body>
<script src="../theme.js"></script>
</html>
    <?php
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