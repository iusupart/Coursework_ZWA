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
<title>FÓRUM</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
<link href="../style/home-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
</head>
<body>
 <div class="wrapper">
     <header class="header">
         <img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="lol">
         <a class="lb-acc" href="../server/logout.php">ODHLÁŠENÍ</a>
         <a class="lb-o" href="<?=$site_url;?>/index.php">HLAVNÍ STRÁNKA</a>
         <a class="lb-out" href="<?=$site_url;?>/modules/acc.php">ÚČET</a>
         <a class="lb-out" href="<?=$site_url;?>/modules/vazba.php">ZPĚTNÁ VAZBA</a>
      </header>

     <div class="case-main">
     <main class="content">
       <div class="contain">
         <div class="new"><span class="but-vy">TEMA</span></div>
        <?php
           /**
            * Zobrazí všechna hlavní témata uložená v DB. 
            */
          $queryz=mysqli_query($db, "SELECT * FROM `razdeli` ");

          if(mysqli_num_rows($queryz)>0)
          {
            while($raz=mysqli_fetch_assoc($queryz))
            {
              $id=$raz['id'];
              $name=$raz['name'];
              ?>
              <div class="contain-text">
              <?php
              print "<a class='text-in-contain' href='themes.php?id=$id'>$name</a><br/>";
              ?>
              </div>
              <?php
            }
          }
          else 
          {
            print "neni tady zadne tema";
          }
        ?> 
        </div>
     </main>
     </div>

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
    header("location:".$site_url."/modules/auth.php");
} 

?>