<?php
/**
 * Pomáhá při nahrávání dát fotografii nový identický název.
 */
function getRandomFileName($path)
{
    $path = $path ? $path . '/' : '';

    do {
        $name = md5(microtime() . rand(0, 9999));
        $file = $path . $name;
    } while (file_exists($file));

    return $name;
}
?>