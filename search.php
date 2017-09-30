<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8;');

$nothing='Ничего не найдено';
$notice='Введите критерий поиска';

function strtolower_Cyrillic($word) {
    $alfavitlover = explode(',', 'ё,й,ц,у,к,е,н,г,ш,щ,з,х,ъ,ф,ы,в,а,п,р,о,л,д,ж,э,я,ч,с,м,и,т,ь,б,ю');
    $alfavitupper = explode(',', 'Ё,Й,Ц,У,К,Е,Н,Г,Ш,Щ,З,Х,Ъ,Ф,Ы,В,А,П,Р,О,Л,Д,Ж,Э,Я,Ч,С,М,И,Т,Ь,Б,Ю');
    
    for($wr=0;$wr<count($alfavitlover);$wr++) {
        $word = str_replace($alfavitupper[$wr], $alfavitlover[$wr], $word);
	}
    return $word;
}


$s=$_POST['search'];  
$search=iconv("UTF-8","cp1251",$s);	

// убираем лишнее
$search=preg_replace("/[^a-zA-ZА-Яа-я0-9\s]/","",$search);
$check=preg_replace("/\s+/","",$search);
if (empty($check)) {echo "<h3>" . iconv("cp1251","UTF-8",$notice) . "</h3>"; exit;}

// делим строку на подстроки   
$search = explode(" ", $search);


$h=file("filmbase");
$max=count($h);
$found=0;
foreach ($h as $str){
	$outMass=explode(":",$str);
	foreach($search as $x){
		if (!empty($x) && preg_match("/".strtolower_Cyrillic($x)."/i",strtolower_Cyrillic($outMass[0]))>0){
		//если нашли то собираем отображение
		$out="<a href=\"#\" onclick=\"window.open('http://vkontakte.ru/".$outMass[2]."');\">".$outMass[0]."</a><br>Год: ".$outMass[1].". Комментариев: ".$outMass[3].". Ср.оценка: <b>".$outMass[4]."</b>. Голосов: ".chop($outMass[5])."<br><br>\n";

		// выделяем найденное
		//$out=preg_replace("/".strtolower_Cyrillic($outMass[0])."/","<span class=\"lighted\">\1</span>",$out);
		echo iconv("cp1251","UTF-8",$out);

		$found=1;
		break;
		}     
	}   	

}       

if ($found==0) {echo "<h3>" . iconv("cp1251","UTF-8",$nothing) . "</h3>";}                                 

?>