<?php
session_start();

require "../server/config.php";
/**
* Ochrana proti nepřihlášeným uživatelům, 
* která bude použita na mnoha stránkách, aby se zabránilo hackingu 
*/
if (isset($_SESSION['id']))
{
$target_dir = "<?=$site_url;?>/server/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/**
 * Zkontrolujte, zda je soubor s obrázkem skutečný obrázek nebo falešný obrázek
 */
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

/**
 * Zkontrolujte, zda soubor již existuje
 */
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

/** 
 * Zkontrolujte velikost souboru
 */ 
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

/**
 * Povolit určité formáty souborů 
 * */  
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

/**
 * Kontrola, zda je hodnota $uploadOk nastavena na 0 v důsledku chyby
 */
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
/**
 * Pokud je všechno v pořádku, jde stážení foto do DB
 */
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "FOTO ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " BYLO ULOŽENO.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
/**
* Ochrana proti nepřihlášeným uživatelům, 
* která bude použita na mnoha stránkách, aby se zabránilo hackingu 
*/
else {
  header("Location:".$site_url);
}
?>