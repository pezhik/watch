<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8;');
$fp = file("filmbase");

echo iconv("cp1251","UTF-8","�������� " . date("d/m/Y", filemtime('filmbase')). ". �������: ". count($fp));                                 

?>