<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=windows-1251;');
$fp = file("filmbase");
echo "Ћбновлен ".date("d/m/Y", filemtime('filmbase')). ". ”ильмов: ". count($fp)
#echo iconv("cp1251","UTF-8","Обновлен " . date("d/m/Y", filemtime('filmbase')). ". Фильмов: ". count($fp));                                 

?>