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
<title>ZPĚTNÁ VAZBA</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
<link href="../style/home-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
<link href="../style/vazba-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link-1">
</head>
<body>
 <div class="wrapper">
     <header class="header">
         <img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="lol">
         <a class="lb-acc" href="../server/logout.php">ODHLÁŠENÍ</a>
         <a class="lb-o" href="<?=$site_url;?>/index.php">HLAVNÍ STRÁNKA</a>
         <a class="lb-out" href="<?=$site_url;?>/modules/acc.php">ÚČET</a>
      </header>

      <!-- Formulář, který se vyplní a odešle na server. -->

     <div class="case-main">
     <main class="content">
       <div class="contain">
         <div class="form-block">
         <form method="post" action="<?=$site_url;?>/modules/vazba.php" class="for-dob" onSubmit="return validate();">
                    <h1>ZPĚTNÁ VAZBA</h1>
                     <label for="tema" class="tema">TÉMA*</label>
                     <input id="tema" type="text" name="tema">
                     <label for="datum" class="tema">DATUM NAROZENÍ</label>
                     <input type="date" name="data" id="datum">
                     <label for="mail" class="tema">KONTAKTNÍ MAIL*</label> 
                     <input type="email" name="mail" id="mail">
                     <label for="tel" class="tema">TEL. ČÍSLO</label>
                     <input type="tel" id="tel" name="tel">
                     <label for="ran" class="tema">JAK NÁS OHODNOTÍTE?*</label>
                     <input type="range" name="ran" id="ran" min="0" max="100" step="20"><br />
                     <input type="submit" id="od" value="Odeslat" name="sub">
           </form>
           <script src="../script/validator-v.js"></script>
         </div>
        <?php
          if (isset($_POST['sub'])) 
          {
            /**
             * Odesílá data na server stejně jako v jiných formulářích. 
             */
            $tema=trim(htmlspecialchars($_POST['tema']));
            $data=$_POST['data'];
            $mail=$_POST['mail'];
            $tel=$_POST['tel'];
            $ran=$_POST['ran'];

            $query000=mysqli_query($db, "INSERT INTO `vazba` (`tema`, `data`, `mail`, `tel`, `ran`)
            VALUES('$tema', '$data', '$mail', '$tel', '$ran')");
            ?>

            <div class="contain-text">
            <?php
            print "DIKY";
            ?>
            </div>
         <?php
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