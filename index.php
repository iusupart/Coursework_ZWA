<?php
session_start();
/** 
 * Adresuje soubor, 
 * který určuje některá specifická nastavení.
*/
require "server/config.php";
/**
 * Funcke se používá pro nastávení stylu (to bude všude)
 */

if(!isset($_SESSION["theme"]))
{
    $_SESSION["theme"] = "light";
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
<title>Hlavní stránka</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="style/indexstyle-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
<link href="style/style-slider.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="img/ico-1.png" type="image/x-icon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="script/scripts.js"></script>

</head>
<body>
 <div id="wrap">
    
    <header class="header">
         <a href="<?=$site_url;?>/index.php"><img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="lol" class="gl-ft"></a>
          <?php 
          /**
           * Tlačítko, které po najetí na hlavní tlačítko otevře malou nabídku s odkazy na další části webu. 
           * "isset" dělá první rozdíl mezi přihlášenými a nepřihlášenými lidmi
           */
          if(isset($_SESSION['id']))
          { 
              ?>
              <div class="button" id="button">Změna tématu</div>
              <a class="dropdown1" href="<?=$site_url;?>/server/logout.php"><div class="dropdown-ins-auth">ODHLÁŠENÍ</div></a>
              <div class="dropdown">
            <button class="dropbtn">MENU</button>
         <div class="dropdown-content">
            <a href="<?=$site_url;?>/modules/home.php">FÓRUM</a>
            <a href="<?=$site_url;?>/okr.php">OKRUHY PRAHY</a>
            <a href="https://onemocneni-aktualne.mzcr.cz/covid-19">COVID-19</a>
            <a href="https://www.msmt.cz/vzdelavani/vysoke-skolstvi/prehled-vysokych-skol-v-cr-3">UNIVERZITY</a>
         </div>
        </div>
              <a class="dropdown1" href="<?=$site_url;?>/modules/acc.php"><div class="dropdown-ins-my-acc">MŮJ ÚČET</div></a>
      
              <?php
          }
          else
          {
      
          }
          ?>
          <?php 
          /**
           * Druhá část tohoto "isset" pro nepřihlášené lidi
           */
          if(!isset($_SESSION['id']))
          { 
              ?>
              <div class="button" id="button">Změna tématu</div>
             <a class="dropdown1" href="<?=$site_url;?>/modules/auth.php"><div class="dropdown-ins-auth">PŘIHLÁSIT SE</div></a>
             <div class="dropdown">
            <button class="dropbtn">MENU</button>
         <div class="dropdown-content">
            <a href="<?=$site_url;?>/modules/home.php">FÓRUM</a>
            <a href="<?=$site_url;?>/okr.php">OKRUHY PRAHY</a>
            <a href="https://onemocneni-aktualne.mzcr.cz/covid-19">COVID-19</a>
            <a href="https://www.msmt.cz/vzdelavani/vysoke-skolstvi/prehled-vysokych-skol-v-cr-3">UNIVERZITY</a>
         </div>
        </div>
              <?php
          }
          else
          {
      
          }
          ?>  
     </header>
    <main class="content">
    <div id="slider" class="span">
				<div class="img image-1"><a href="<?=$site_url;?>/modules/home.php"><img src="http://images.vfl.ru/ii/1636311344/85b7fcc2/36589126.jpg" alt="" style="margin-top: -140px;"></a></div>
				<div class="img image-2"><a href="https://onemocneni-aktualne.mzcr.cz/covid-19"><img src="http://images.vfl.ru/ii/1636311344/ed9be0ba/36589125.jpg" alt="" style="margin-top: -50px;"></a></div>
				<div class="img image-3"><a href="<?=$site_url;?>/okr.php"><img src="http://images.vfl.ru/ii/1636311342/d19470b4/36589124.png" alt="" style="margin-top: -100px;"></a></div>
				<div class="img image-4"><a href="https://www.msmt.cz/vzdelavani/vysoke-skolstvi/prehled-vysokych-skol-v-cr-3"><img src="http://images.vfl.ru/ii/1636311342/cf35146d/36589123.jpg" alt="" style="margin-top: -50px;"></a></div>
				<div class="nav previous"></div>
				<div class="nav next"></div>
				<div class="previews">
					<div class="preview previous-image"></div>
					<div class="preview next-image"></div>
				</div>
			</div>
			<div id="dots">
				<ul></ul>
			</div>
    </main>
</div>

<footer class="footer">
    <div>
      <span class="text-footer">ČVUT V PPAZE</span>
    </div>
</footer>
<script src="script/theme.js"></script>
<script src="script/snow.js"></script>
</body>
</html>
