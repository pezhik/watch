<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=windows-1251;');
$fp = file("filmbase");
echo "�������� ".date("d/m/Y", filemtime('filmbase')). ". �������: ". count($fp)
#echo iconv("cp1251","UTF-8","�������� " . date("d/m/Y", filemtime('filmbase')). ". �������: ". count($fp));                                 

?>