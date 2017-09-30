<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8;');

$nothing='������ �� �������';
$notice='������� �������� ������';

function strtolower_Cyrillic($word) {
    $alfavitlover = explode(',', '�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�');
    $alfavitupper = explode(',', '�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�,�');
    
    for($wr=0;$wr<count($alfavitlover);$wr++) {
        $word = str_replace($alfavitupper[$wr], $alfavitlover[$wr], $word);
	}
    return $word;
}


$s=$_POST['search'];  
$search=iconv("UTF-8","cp1251",$s);	

// ������� ������
$search=preg_replace("/[^a-zA-Z�-��-�0-9\s]/","",$search);
$check=preg_replace("/\s+/","",$search);
if (empty($check)) {echo "<h3>" . iconv("cp1251","UTF-8",$notice) . "</h3>"; exit;}

// ����� ������ �� ���������   
$search = explode(" ", $search);


$h=file("filmbase");
$max=count($h);
$found=0;
foreach ($h as $str){
	$outMass=explode(":",$str);
	foreach($search as $x){
		if (!empty($x) && preg_match("/".strtolower_Cyrillic($x)."/i",strtolower_Cyrillic($outMass[0]))>0){
		//���� ����� �� �������� �����������
		$out="<a href=\"#\" onclick=\"window.open('http://vkontakte.ru/".$outMass[2]."');\">".$outMass[0]."</a><br>���: ".$outMass[1].". ������������: ".$outMass[3].". ��.������: <b>".$outMass[4]."</b>. �������: ".chop($outMass[5])."<br><br>\n";

		// �������� ���������
		//$out=preg_replace("/".strtolower_Cyrillic($outMass[0])."/","<span class=\"lighted\">\1</span>",$out);
		echo iconv("cp1251","UTF-8",$out);

		$found=1;
		break;
		}     
	}   	

}       

if ($found==0) {echo "<h3>" . iconv("cp1251","UTF-8",$nothing) . "</h3>";}                                 

?>