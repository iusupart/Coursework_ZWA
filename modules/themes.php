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
<title>TÉMATA</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
<link href="../style/th-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">

</head>
<body>
 <div class="wrapper">
     <header class="header">
     <img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="lol">
     <a class="lb-out-back" href="<?=$site_url;?>/modules/home.php">ZPÁTKY</a>
     </header>
     <div class="case-main">
     <main class="content">
         <?php
         /**
          * Zobrazí všechny diskuse na dané téma
          */
         if(isset($_GET['id']) & is_numeric($_GET['id']))
         {
            $id_ses=$_SESSION['id'];
            $id_razd=$_GET['id'];
            $queryy=mysqli_query($db, "SELECT * FROM `themes` WHERE `razdel`=$id_razd");
            if(mysqli_num_rows($queryy) > 0)
            {
                ?>
                <div class="new">
                <a class="but-vy" href="<?=$site_url;?>/modules/themeadd.php?id=<?=$id_razd;?>">Vytvorit</a>
                </div>
                <?php
                while($ctg=mysqli_fetch_assoc($queryy))
                {
                    $id=$ctg['id'];
                    $id_user=$ctg['iduser'];
                    $id_raza=$ctg['razdel'];
                    $theme_name=$ctg['name'];
                    $message=$ctg['message'];

                    ?>
                     <div class="themewrap">
                         <div class="tname"><a href="<?=$site_url?>/modules/themeshow.php?id=<?=$id?>&pageno=1"><?=$theme_name?></a>
                         <?php
                         $querythsu=mysqli_query($db, "SELECT * FROM `users` WHERE id=$id_ses");
                         $usc=mysqli_fetch_assoc($querythsu);
                         if(isset($usc))
                         { 
                         $login=$usc['login'];
                         $user_class=$usc['user_class'];
                         similar_text($user_class,'USER',$user_class1);
                         similar_text($user_class,'ADMIN',$user_class2);

                         }
                         else
                         {

                         } 
                         
                         if($user_class1 == '100%')
                            {
                                
                            }
                            /**
                             * Správce má funkci pro odstranění komentáře.
                             */
                            elseif($user_class2 == '100%'){ 
                        ?>   <span><a class= "dec-a" href="../server/del_t.php?id=<?=$id_raza;?>&id_t=<?=$id;?>">❌</a></span> <?php
                            }
                        ?>
                        </div>
                         <div class="ttime">
                         <span> DATE
                         <?php
                         /**
                          * U každého tématu je také odkaz na přesnější informace. 
                          */
                         /**
                          * Zobrazí datum vytvoření 
                          */
                         $querycount_date=mysqli_query($db, "SELECT * FROM `themes` WHERE `id`=$id");
                         $qseen_date=mysqli_fetch_assoc($querycount_date);
                         $date=$qseen_date['date'];
                         print "$date";


                         ?>
                         </span>
                         </div>
                         <div class="tcomment">
                         <span>
                                 NAME
                                 <?php 
                                 /**
                                  * Zobrazí autora
                                  */
                                 $querycount_search=mysqli_query($db, "SELECT * FROM `themes` WHERE `id`=$id");
                                 $qseen=mysqli_fetch_assoc($querycount_search);
                                 $user_name=$qseen['iduser'];
                                 $query_name=mysqli_query($db, "SELECT * FROM `users` WHERE `id`=$user_name");
                 
                                 $qseen_name=mysqli_fetch_assoc($query_name);
                                 $qname=$qseen_name['login'];

                                 print "$qname";
                                 ?>
                             </span>
                         </div>
                         <div class="tseen"> 
                             <span>
                                 SEEN
                                 <?php 
                                 /**
                                  * Vypíše počet nálezů
                                  */
                                 $querycount_search=mysqli_query($db, "SELECT * FROM `themes` WHERE `id`=$id");
                                 $qseen=mysqli_fetch_assoc($querycount_search);
                                 $seen=$qseen['cout'];

                                 print "$seen";
                                 ?>
                             </span>
                         </div>
                     </div>
                    <?php
                }
            }
            /**
             * Pokud není žádná téma, vypiše to
             */
            else
            {
                print "neni tady zadna tema, <a href='$site_url/modules/themeadd.php?id=$id_razd'>vytvori temu</a>";
            }
         }
         else
         {
             header("Location:".$site_url);
         }
         ?>
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
    header("location:".$site_url);
}
  ?>