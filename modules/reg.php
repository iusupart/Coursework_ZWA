<?php
session_start();

require "../server/config.php";
/**
 * Pokud je osoba již zaregistrována, na tuto stránku se nedostane.
 */
if(isset($_SESSION['id']))
  {
    header("Location:". $site_url);
  }
else
  {
    if (isset($_GET['id']))
     {
        $id_cook = $_GET['id'];
     }

     else
     {

     }

     if (isset($_GET['id_a']))
     {
        $id_cook_a = $_GET['id_a'];
     }

     else
     {
       
     }

    if (isset($_GET['res']))
    {
      $result = $_GET['res'];
    }
    
    else 
     {

     }
     if (isset($_GET['mail']))
     {
        $id_cook_mail = $_GET['mail'];
     }
    
    else 
     {
       
     }
    
    ?>
    
  <!DOCTYPE html>
    <html lang="cs">
    <head>
      <title>REGISTRACE</title>
      <link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
      <link href="../style/auth-<?php echo $_SESSION["theme"];?>.css" type="text/css" rel="stylesheet" id="theme-link">
      <link href="../style/reg.css" type="text/css" rel="stylesheet">
    </head>
    <body>
    <header class="header">
      <h1 class="head-auth">
      Zaregistrovat se</h1>
      <div class="text-to-home"><a class="text-to-home-a-header" href="<?=$site_url;?>/index.php">VRATIT SE DOMU</a></div>
    </header> 
    <div class="main">
      <div class="container-login">
        <div class="pack-login">
          <form class="reg-valid" action="<?=$site_url;?>/server/reg.php" method="POST" onSubmit="return validate();">
            <div class="input-text">
              <input type="text" id="login" name="login" placeholder="login (min. 5 - max. 15)(jenom písmena)*" onkeyup="check(this.value)" minlength="5" maxlength="15" value="<?php
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
             <input type="password" name="password" id="password" onkeyup="checko(this.value)" placeholder="password (min. 7)*" minlength="7" /> 
             <span id="e_login_1">Heslo není zadáno správně</span>
             <br />
           </div>

           <div class="input-text">
            <input type="email" name="email" id="email" placeholder="email*" onkeyup="checkom(this.value)" value="<?php
              /**
               * Pokud existuje email, který jsme dostali přes GET, dostaneme zpátky naše uživatelské jmeno tady
               */
              if(isset($id_cook_mail))
              {
                print $id_cook_mail;
              }
              else
              {

                } 
              ?>"/> 
              <span id="e_login_2">Je třeba napsát svůj e-mail</span>
              <br />
          </div>
           
           <div class="main-button"> 
             <button class="button"  type="submit" name="sub" value="Enter">
               REGISTER
             </button>
             <div class="text-to-auth"><a class="text-to-auth-a" href="<?=$site_url;?>/modules/auth.php">VRATIT SE ZPATKY</a></div>
             <div class="text-to-auth">
              <?php
              if(isset($result))
              {
                if($result == '1')
                {
                  print "Uživatel je už zaregistrovan, zkuste ještě jednou";
                }
                if($result == '2')
                {
                  print "Máte špatný login, zkuste ještě jednou";                
                }
                if($result == '3')
                {
                  print "Ted se muzes autorizovat, proste "?> <a class= "text-main-flex-1" href="../modules/auth.php?id=<?=$id_cook_a;?>">klikni</a> <?php print "tady";                
                }
                if($result == '4')
                {
                  print "Něco se nepodářilo, zkuste ještě jednou"; 
                }
              }
              else
              {

              }
              ?>
              </div>
           </div>  
          
          <div class="main-flex">
            <span class="text-main-flex">
            </span>
          </div>
          </form>
             <!-- Script pro validaci -->
          <script src="../script/valid-au.js"></script>
          <script src="../script/validator-r.js"></script>
        </div>
      </div>
    </div>
    </body>
    <script src="../theme.js"></script>
    </html>

    

    <?php
}

?>