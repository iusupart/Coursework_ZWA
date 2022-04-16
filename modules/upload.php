<?php 
session_start();
require "../server/config.php";

$idses=$_SESSION['id'];

$query_check=mysqli_query($db, "SELECT * FROM `foto` WHERE `fotoid` = '$idses'");

  

  if (isset($_FILES['images'])) {
    if (((isset($_SESSION['img'])) && ($_SESSION['img'] == $_FILES['images']))) 
{
    header("Location: ".$site_url."/modules/acc.php?err=1");
    exit;
}
    $_SESSION['img'] = $_FILES['images'];
     // Změna struktury  $_FILES
    foreach($_FILES['images'] as $key => $value) {
        foreach($value as $k => $v) {
            $_FILES['images'][$k][$key] = $v;
        }
        // Odstranění starých klíčů 
        unset($_FILES['images'][$key]);
      
    }
    // Nahrávání všech obrázků v pořadí 
    foreach ($_FILES['images'] as $k => $v) {
        $fileName = $_FILES['images'][$k]['name'];
        $fileTmpName = $_FILES['images'][$k]['tmp_name'];
        $fileType = $_FILES['images'][$k]['type'];
        $fileSize = $_FILES['images'][$k]['size'];
        $errorCode = $_FILES['images'][$k]['error'];

        // Kontrola chyb 
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
            // Veškeré možné chyby 
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Velikost souboru překročila hodnotu upload_max_filesize v konfiguraci PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Velikost nahraného souboru překročila hodnotu MAX_FILE_SIZE ve formuláři HTML.',
                UPLOAD_ERR_PARTIAL    => 'Stažený soubor byl přijat pouze částečně.',
                UPLOAD_ERR_NO_FILE    => 'Soubor nebyl nahrán.',
                UPLOAD_ERR_NO_TMP_DIR => 'Neexistuje žádná dočasná složka.',
                UPLOAD_ERR_CANT_WRITE => 'Soubor se nepodařilo zapsat na disk.',
                UPLOAD_ERR_EXTENSION  => 'Rozšíření PHP zastavilo stahování souboru.',
            ];
            $unknownMessage = 'Při stahování souboru došlo k neznámé chybě.';
            // Pokud v poli není žádný kód chyby, řekneme, že chyba je neznámá.
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            die($outputMessage."<a href=".$site_url."/modules/acc.php>ještě jednou</a>");
        } else {
            // Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string) finfo_file($fi, $fileTmpName);
            if (strpos($mime, 'image') === false) die('Můžete nahrávat pouze obrázky.');
            $image = getimagesize($fileTmpName);
            // Nastavení omezení pro obrázky
            $limitBytes  = 2480 * 2480 * 5;
            $limitWidth  = 2480;
            $limitHeight = 2480;
            // Kontrola parametrů
            if (filesize($fileTmpName) > $limitBytes) die('Velký obrázek');
            if ($image[1] > $limitHeight)             die('Velký obrázek ');
            if ($image[0] > $limitWidth)              die('Velký obrázek ');
            // Genetujeme nové jmeno přes functions.php
            $name = uniqid($fileTmpName);
            $extension = image_type_to_extension($image[2]);
            $format = str_replace('jpeg', 'jpg', $extension);
            // Dáme nový soubor do složky /pics
            if (!move_uploaded_file($fileTmpName, __DIR__ . '/pics' . $name . $format)) {
                die('Při zápisu obrazu na disk došlo k chybě.');
            }
        }
    };
    $db=mysqli_connect("localhost", "iusupart", "webove aplikace", "iusupart");
    $fotoid = $_SESSION['id'];
    $queryfoto=mysqli_query($db, "INSERT INTO `img` (`fotoid`, `foto`, `format`)
                  VALUES($fotoid, '$name', '$format')");
    header("Location:".$site_url."/modules/acc.php");
  };


?>