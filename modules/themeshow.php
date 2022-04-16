<?php 
session_start();

require "../server/config.php";

if (isset($_SESSION['id']))
{
    $theme_id=$_GET['id'];

    ?>
    <!DOCTYPE html>
<html lang="cs">
<head>
<title>VŠECHNA TÉMATA</title>
<meta charset="utf-8">
<link rel="shortcut icon" href="../img/ico-1.png" type="image/x-icon">
<link href="../style/ths-<?php echo $_SESSION["theme"]; ?>.css" type="text/css" rel="stylesheet" id="theme-link">

</head>
<body>
 <div class="wrapper">
     <header class="header">
         <?php
         $querythsu=mysqli_query($db, "SELECT * FROM `themes` WHERE id=$theme_id");
         $q_t=mysqli_fetch_assoc($querythsu);
         $theme_b=$q_t['razdel'];
         ?>
        <img src="http://images.vfl.ru/ii/1635692315/aad43ab2/36489486.png" alt="logo">
        <a class="lb-out-back" href="<?=$site_url;?>/modules/home.php">ZPĚT NA DOMOVSKOU STRÁNKU FÓRA</a>
        <a class="lb-out-back" href="<?=$site_url;?>/modules/themes.php?id=<?=$theme_b;?>">ZPÁTKY</a>
     </header>
     <div class="case-main">
     <main class="content">
         <?php 
         /**
          * Funkce pro přidání návštěv do DB, aby se později zobrazily v databázi 
          */
         if(isset($_GET['id']) & is_numeric($_GET['id']))
         {
            $id_ses=$_SESSION['id'];

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
               

            $id_theme=$_GET['id'];
            $queryf=mysqli_query($db, "SELECT * FROM `themes` WHERE `id`=$id_theme LIMIT 1");
                /**
                 * Následující příkaz vezme všechny existující komentáře z databáze a 
                 * postupně je zobrazí určitým stylem, rozdělí je na několik částí a vytvoří stránky, 
                 * které konzistentně zobrazují všechny komentáře. 
                 */
                while($ctg=mysqli_fetch_assoc($queryf))
                {
                    $id=$ctg['id'];
                    $id_user=$ctg['iduser'];
                    $id_raza=$ctg['razdel'];
                    $theme_name=$ctg['name'];
                    $message=$ctg['message'];

                    $querythsu=mysqli_query($db, "SELECT * FROM `users` WHERE id=$id_user");
                    $lol=mysqli_fetch_assoc($querythsu);
                    if(isset($lol))
                    { 
                    $login=$lol['login'];
                    $usss=$lol['user_class'];
                    }
                    else{
               
                    }
               
               
                    /**
                     * Zobrazuje také hlavní komentáře a fotografie, hlavní informace o osobě, které jsou převzaty z 
                     * databáze a synchronizovány s identifikátorem osoby, 
                     * která příspěvek napsala (aby se předešlo chybám).
                     */
                    $querydibths=mysqli_query($db, "SELECT * FROM `dopinf` WHERE id_user=$id_user");
                    $lol1=mysqli_fetch_assoc($querydibths);
                    if(isset($lol1))
                    { 
                       $praha=$lol1['praha'];
                       $uni=$lol1['uni'];
                       $pohl=$lol1['pohl'];
                    }
                    else{
               
                    }
               
               
          
                    $queryfotoselectths=mysqli_query($db, "SELECT * FROM `img` WHERE fotoid=$id_user");
                    $fotodb=mysqli_fetch_assoc($queryfotoselectths);
                    if(isset($fotodb))
                    { 
                       $fotoid=$fotodb['fotoid'];
                       $foto=$fotodb['foto'];
                       $format=$fotodb['format'];
                    }
                    else{
                    
                    }
                    ?>
                    <div class="topicshow">
                        <div class="topicuser">
                        <span>
                             <?php
                             if (isset($fotoid)) 
                             {
                                 ?>
                                 <img class="img-comment" src="pics<?=$foto;?><?=$format;?>" alt="lol">
                                 <?php
                             }
                             if (!isset($fotodb))
                             {
                                 ?>
                               <img class="img-comment" src="https://gofederation.ru/img/userpic/279861701" alt="img">
                               <?php
                             }
                             ?>
                             </span>
                             <span class="info-comm">NICK:
                             
                             <?php 
                             if(isset($lol))
                             { 
                             print "$login";
                             }
                             else
                             {
                                 print "-";
                             }
                    
                             ?> 
                             </span> 
                             <span class="info-comm">PRAHA:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$praha";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span> 
                             <span class="info-comm">UNIVETZITA:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$uni";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span> 
                             <span class="info-comm">POHLAVI:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$pohl";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span>                  
                        </div>
                        <div class="topicmessage">
                            <?php
                            ?>
                            <div class="text-in">
                            <?php
                            print "<h1>".$theme_name."</h1>";
                            print "<br />";
                            print $message;
                            ?>
                            </div>
                            <?php
                            ?>
                        </div>
                    </div>
                    <?php
                }
            ?>
            <br />
            <?php
            
            /**
             * Proces rozdělení příspěvku na stránce - vypočítá se celkový počet položek a 
             * stránek (všechny položky se vydělí počtem povolených položek na stránce). 
             * Poté jsou vytvořeny jednotlivé stránky a metoda GET slouží k zobrazení všech prvků na stránkách a 
             * databázových částí.
             */
                 if (isset($_GET['pageno']) & is_numeric($_GET['pageno'])) {            
                    $pageno = $_GET['pageno'];
                } 
                
                elseif (!is_numeric($_GET['pageno']))
                {
                    ?> <div class="content-err"> <?php
                    exit("Není taková stránka <a href=".$site_url."/modules/themeshow.php?id=".$theme_id."&pageno=1>LOL</a>");
                    ?> </div> <?php
                }

                
                else { 
                    $pageno = $_GET['pageno'] = 1;
                }
                $size_page = 2;  
                $offset = ($pageno-1) * $size_page;
                $count_sql = "SELECT COUNT(*) FROM `comments`";
                $result = mysqli_query($db, $count_sql);               
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $size_page);

                if ((($_GET['pageno'] > $total_pages) & ($_GET['pageno'] != 1)) || ($_GET['pageno'] <= 0))
                {
                    ?> <div class="content-err"> <?php
                    exit("Není taková stránka");
                    ?> </div> <?php
                }

                
                $querylo=mysqli_query($db, "SELECT * FROM `comments` WHERE `topicid`=$id_theme LIMIT $offset, $size_page");
                 if(mysqli_num_rows($querylo)>0)
                 {
                     while($ctg=mysqli_fetch_assoc($querylo))
                     {
                     
                         $comment_user_id=$ctg['userid'];
                         $comment=$ctg['commenttext'];

                    $querythsu=mysqli_query($db, "SELECT * FROM `users` WHERE id=$comment_user_id");
                    $lol=mysqli_fetch_assoc($querythsu);
                    if(isset($lol))
                    { 
                    $login=$lol['login'];
                    $user_class=$lol['user_class'];
                    similar_text($user_class,'USER',$user_class3);
                    }
                    else{
               
                    }
               

                    $querydibths=mysqli_query($db, "SELECT * FROM `dopinf` WHERE id_user=$comment_user_id");
                    $lol1=mysqli_fetch_assoc($querydibths);
                    if(isset($lol1))
                    { 
                       $praha=$lol1['praha'];
                       $uni=$lol1['uni'];
                       $pohl=$lol1['pohl'];
                    }
                    else{
               
                    }
                     
                    $queryfotoselectths=mysqli_query($db, "SELECT * FROM `img` WHERE fotoid=$comment_user_id");
                    $fotodb1=mysqli_fetch_assoc($queryfotoselectths);
                    if(isset($fotodb1))
                    { 
                       $fotoid1=$fotodb1['fotoid'];
                       $foto1=$fotodb1['foto'];
                       $format1=$fotodb1['format'];
                    }
                    
                         ?>
                           <div class="commentshow">
                          <div class="commentuser">
                          
                             <span>
                             <?php
                             /**
                              * Zobrazení foto a další informací
                              */
                             if (isset($fotodb1)) 
                             {
                                 ?>
                                 <img class="img-comment" src="pics<?=$foto1;?><?=$format1;?>" alt="lol">
                                 <?php
                             }
                             else
                             {
                              
                                 ?>
                               <img class="img-comment" src="pics/tmp/def.png" alt="LOL">
                               <?php
                             }
                             ?>
                             </span>
                             <span class="info-comm">NICK:
                             <?php 
                             if(isset($lol))
                             { 
                             print "$login";
                             }
                             else
                             {
                                 print "-";
                             }
                             ?> 
                             </span> 
                             <span class="info-comm">PRAHA:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$praha";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span> 
                             <span class="info-comm">UNIVETZITA:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$uni";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span> 
                             <span class="info-comm">POHLAVI:
                             <?php
                                 if(isset($lol1))
                                 { 
                                 print "$pohl";
                                 }
                                 else
                                 {
                                     print "-";
                                 }
                                 ?>
                             </span> 
                             <?php
                             if($user_class1 == '100%')
                            {
                                
                            }
                            /**
                             * Správce má funkci pro odstranění uživatele.
                             */
                            elseif(($user_class2 == '100%') && ($user_class3 == '100%')){ 
                            $query_for_us_id=mysqli_query($db, "SELECT * FROM `users` WHERE `id`='$comment_user_id'"); 
                            $for_id_us=mysqli_fetch_assoc($query_for_us_id);
                            $id_us=$for_id_us['id'];
                            ?> <a class= "dec-a" href="../server/del_p.php?id_u=<?=$id_us;?>&id_t=<?=$theme_id;?>&th_b=<?=$theme_b;?>">❌</a> <?php ;
                             }
                            ?>
                        
                          </div>
                          <div class="commentmessage">
                              <div class="admin">
                            <?php
                            print $comment;  
                            ?>
                            </div>
                            <?php
                            if($user_class1 == '100%')
                            {
                                
                            }
                            /**
                             * Správce má funkci pro odstranění komentáře.
                             */
                            elseif($user_class2 == '100%'){ 
                            $query_for_com_id=mysqli_query($db, "SELECT * FROM `comments` WHERE `commenttext`='$comment'"); 
                            $for_id_comm=mysqli_fetch_assoc($query_for_com_id);
                            $id_com=$for_id_comm['id'];
                            ?> <div class="a-del"><a class= "text-main-a" href="../server/del.php?id=<?=$theme_id;?>&id_com=<?=$id_com;?>">❌</a></div> <?php ;
                             }
                            ?>

                           
                        </div>
                       </div>
                    <?php
                     }
                 }
                 else
                 {
                     print "Není tady ani slovo";
                 }
            
            ?>
            <br>
            <div>
            <?php
               if(isset($_GET['emf']))
               {
                   if($_GET['emf']==1)
                   {
                       print "Je třeba napsat komentář";
                   }
                   if($_GET['emf']==2)
                   {
                       print "Nějaký problém, zkuste ještě jednou";
                   }
               }
               ?>
               <br />
            </div>

            <form method="POST" action="<?=$site_url;?>/server/commentadd.php">
                <textarea name="commentadd" placeholder="Tady můžete napsát svůj komentář"></textarea><br>
                <input type="hidden" name="idtheme" value="<?=$id_theme?>"><br />
                <input class="bttn" type="submit" name="sub3" value="ODESLAT"> 
            <?php
            /**
             * V dolní části jsou tlačítka - odkazy na stránkování, které se mění podle toho, na které stránce se nacházíte.
             */
            ?>
            </form>
            <ul class="pagination">
                <li><a href="?id=<?=$theme_id;?>&pageno=1">První</a></li>
                <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?id=".($theme_id)."&pageno=".($pageno - 1); } ?>">Předchozí</a>
                </li>
                <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?id=".($theme_id)."&pageno=".($pageno + 1); } ?>">Příští</a>
                </li>
                <li><a href="?id=<?=$theme_id;?>&pageno=<?php echo $total_pages; ?>">Poslední</a></li>
            </ul>
              

            <?php


            
                    
            
         }
         else
         {
             header("Location:".$site_url);
         }
         ?>
     </main> 
      </div>
  
 <footer class="footer">
      <span class="footer-text">ČVUT V PRAZE</span>
 </footer>
 </div>
 <script src="../theme.js"></script>
</body>
</html>
    <?php
}
else 
{
    header("location:".$site_url);
}    
?>