<?php
session_start();

require "../server/config.php";

/**
 * Nastavuje jmeno pro pamatování
 */
if (isset($_GET['res']))
{
  $result = $_GET['res'];
}
if (isset($_GET['id']))
{
  $id_cook = $_GET['id'];
}

else
{

}

/**
 * Pokud je osoba již zaregistrována, na tuto stránku se nedostane.
 */
if(!isset($_SESSION['id']))
{
    ?>
    <!DOCTYPE html>
    <html lang="cs">
    <head>
      <title>PŘIHLÁŠENÍ</title>
      <link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
      <link href="../style/auth-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
    </head>
    <body>

    <header class="header">
      <h1 class="head-auth">
       Přihlásit se</h1>
      <div class="text-to-home"><a class="text-to-home-a-header" href="<?=$site_url;?>/index.php">VRÁTIT SE ZPÁTKY</a></div>
    </header>
    <div class="main">
      <div class="container-login">
        <div class="pack-login">
          </header>
          <main class="content">
          <form class="login-valid" action="<?=$site_url;?>/server/auth.php" method="POST" name="login-valid" onSubmit="return validate();">
            <div class="input-text">
              <input type="text" id="login" name="login" pattern="[A-Za-z]{5,15}" onkeyup="check(this.value)" placeholder="login*" class="login" value="<?php
              /**
               * Pokud existuje login, který jsme dostali přes GET, dostaneme zpátky naše uživatelské jmeno tady
               */
              if(isset($id_cook))
              {
                print $id_cook;
              }
              else
              {

                } 
              ?>" />
              <span id="e_login">Uživatelské jméno není zadáno správně</span>
              <br />
            </div>
            
           <div class="input-text">
             <input type="password" id="password" onkeyup="checko(this.value)" name="password" placeholder="password*" />
             <span id="e_login_1">Heslo není zadáno správně</span> <br />
           </div>
           
           <div class="main-button"> 
             <button class="button" id="button"  type="submit" name="sub" value="Enter">
               LOGIN
             </button>
           </div>  
          
          </span>

          <div class="main-flex">
          <span class="text-main-flex">
          <?php
            if(isset($result))
            {
              print "Heslo nebo jmeno není správné<br />";
            }
            else
            {
              print "Nemáš účet?";
            }
          ?>          
          </span>
          <br />
          <?php
          if(isset($result))
          {

          }
          else
          {
            ?>
            <a href="reg.php" class="text-main-flex-1">
              Zaregistrovat se teď
            </a>
            <?php
          }
          ?>
          </div>
          </form>
           <!-- Script pro validaci -->
           <script src="../script/valid-au.js"></script>
          <script src="../script/validator.js"></script>
        </main>
        </div>
      </div>
    </div>
    </body>
   
    <script src="../theme.js"></script>
    </html> 
    <?php
}
 
else
{
  header("Location:". $site_url);
}

?>