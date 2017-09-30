<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=windows-1251;');
$fp = file("filmbase");
echo "ќбновлен ".date("d/m/Y", filemtime('filmbase')). ". Ф‘ильмов: ". count($fp)
#echo iconv("cp1251","UTF-8","ќбновлен " . date("d/m/Y", filemtime('filmbase')). ". ‘ильмов: ". count($fp));                                 

?>