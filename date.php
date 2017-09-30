<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8;');
$fp = file("filmbase");

echo iconv("cp1251","UTF-8","Обновлен " . date("d/m/Y", filemtime('filmbase')). ". Фильмов: ". count($fp));                                 

?>