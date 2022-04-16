<?php 
session_start();

require "../server/config.php";

if (isset($_SESSION['id']))
{
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <title>MŮJ ÚČET</title>
    <link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
    <link href="../style/acc-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">
</head> 
 <body>
    <main class="content">
        <div class="package-lb">
             <div class="foto-lb">
              <?php 
              $id_foto=$_SESSION['id'];
              $queryfotoselect=mysqli_query($db, "SELECT * FROM `img` WHERE fotoid=$id_foto");
              $fotodb=mysqli_fetch_assoc($queryfotoselect);
              if(isset($fotodb)) {
                $fotoid=$fotodb['fotoid'];
                $foto=$fotodb['foto'];
                $format=$fotodb['format'];
              
              if (isset($fotoid)) 
              {
                  ?>
                  <img src="pics<?=$foto;?><?=$format;?>" alt="lol">
                  <?php
              }
              }

              else
              {
                  ?>
                <img src="http://images.vfl.ru/ii/1635692247/3f290b99/36489475.jpg" alt="lol">
                <?php
              }
              ?>
             <div class="text-info">

                <?php
                 $id=$_SESSION['id'];
                 $query9=mysqli_query($db, "SELECT * FROM `users` WHERE id=$id");
                 $lol=mysqli_fetch_assoc($query9);
                 $login=$lol['login'];
                 $email=$lol['email'];
                 $user_class=$lol['user_class'];

                 $id_user=$_SESSION['id'];
                 $querydobbbb=mysqli_query($db, "SELECT * FROM `dopinf` WHERE id_user=$id_user");
                 $lol1=mysqli_fetch_assoc($querydobbbb);
                 if(isset($lol1))
                 { 
                 $praha=$lol1['praha'];
                 $uni=$lol1['uni'];
                 $pohl=$lol1['pohl'];
                 }
                 ?>
                 
                 <span class="info">NICK:
                 <?php print "$login";
                 ?> 
                 </span> 
                 <span class="info">EMAIL:
                     <?php
                     print "$email";
                     ?>
                 </span> 
                 <span class="info">PRAHA:
                 <?php 
                  if(isset($praha))
                  {
                    print "$praha";
                  }  
                  else 
                  {
                      print "-";
                  } 
                     ?>
                 
                 </span> 
                 <span class="info">UNIVETZITA:
                 <?php 
                  if(isset($uni))
                  {
                    print "$uni";
                  }  
                  else 
                  {
                      print "-";
                  } 
                     ?>
                 </span> 
                 <span class="info">POHLAVI:
                 <?php 
                  if(isset($pohl))
                  {
                    print "$pohl";
                  }  
                  else 
                  {
                      print "-";
                  } 
                     ?>
                 </span>
                <span class="info">
                <?php
                print "$user_class"
                ?>
                </span>                 
             </div>
             </div>
             <?php
              if (isset($_POST['subd']))
              {
               $praha=trim(htmlspecialchars($_POST['praha']));
               $uni=trim(htmlspecialchars($_POST['uni']));
               $pohl=trim(htmlspecialchars($_POST['pohl']));
               $id_user=$_SESSION['id'];

               $querydob=mysqli_query($db, "INSERT INTO `dopinf` (`praha`, `uni`, `pohl`, `id_user`)
                VALUES('$praha', '$uni', '$pohl', $id_user)");
                
                
                if(!$querydob)
                {
                    print "Something wrong";
                }

              }


             ?>
             <div class="other-lb">
                 <div class="case-text-to-back"><span class="text-to-back"><a href="<?=$site_url;?>/modules/home.php">FÓRUM</a></span></div>
                 <div class="case-text-to-back"><span class="text-to-back"><a href="<?=$site_url;?>/index.php">HLAVNÍ STRÁNKA</a></span></div>
                <div class="pack-form">
                <form method="post" action="<?=$site_url;?>/modules/acc.php" class="for-dob">
                    <h1>MŮŽETE PŘIDAT ÚDAJE</h1>
                     <label for="praha" class="praha">PRAHA</label>
                     <select id="praha" name="praha">
                       <option value="PRAHA 1">PRAHA 1</option>
                       <option value="PRAHA 2">PRAHA 2</option>
                       <option value="PRAHA 3">PRAHA 3</option>
                       <option value="PRAHA 4">PRAHA 4</option>
                       <option value="PRAHA 5">PRAHA 5</option>
                       <option value="PRAHA 6">PRAHA 6</option>
                       <option value="PRAHA 7">PRAHA 7</option>
                       <option value="PRAHA 8">PRAHA 8</option>
                       <option value="PRAHA 9">PRAHA 9</option>
                       <option value="PRAHA 10">PRAHA 10</option>
                       <option value="NEJSEM S PRAHY">NEJSEM S PRAHY</option>
                     </select> <br />
                     <label for="uni" class="uni">UNIVETZITA</label>
                     <select id="uni" name="uni">
                       <option value="ČVUT">ČVUT</option>
                       <option value="VŠE">VŠE</option>
                       <option value="ČZU">ČZU</option>
                       <option value="VŠCHT">VŠCHT</option>
                     </select> <br />
                     <label for="pohl" class="pohl">POHLAVI</label>
                     <select id="pohl" name="pohl">
                       <option value="MUŽ">MUŽ</option>
                       <option value="ŽENA">ŽENA</option>
                     </select> <br />

                     <?php

                     if(!isset($praha) && !isset($uni) && !isset($pohl)) {
                         ?>
                     <button class="button" type="submit" name="subd" value="Enter">DODAT</button>
                     <?php
                    }
                    else {

                    }
                     ?>
                </form>  
                <?php
                if(!isset($queryfotoselect))
                {
                ?>
                 <form action="upload.php" method="post" enctype="multipart/form-data">
                     <input type="file" name="images[]" multiple />
                     <button type="submit">Podtvrdit</button>
                     <?php
                  
                    
                       if(isset($_GET['err']))
                       {
                         ?><div class="err"><?php
                         print "Je třeba nahrát něco jiného";
                         ?></div><?php
                       }
                       else
                       {

                       }
                       ?>
                     </div>
                      </form>
                  <?php
                      }
                      else
                     {

                     }


       
                if (isset($_POST['subd']))
                {
                  print "obnovit <a href=''>stranku</a>";
                }
                ?>

                </div> 
            </div>
        </div>
    </main>
 </body>  
 <script src="../theme.js"></script>
</html>

<?php
}
else 
{
    header("location:".$site_url);
} 
?>