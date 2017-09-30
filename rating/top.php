<?php
// xls должен быть со след.колонками - позиция, название, год, ссылка, коммет, голосов, оценка

date_default_timezone_set('Europe/Moscow');
//header('Access-Control-Allow-Origin: *');
//header('Content-Type: text/html; charset=windows-1251;');

echo '
<html>
<head>
	<title>250 лучших фильмов по версии VSFC</title>
	<link rel="stylesheet" href="css/vsfc.css" type="text/css" media="all" />	
	<link rel="stylesheet" href="css/rating.css" type="text/css" media="all" />
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<META http-equiv="content-type" content="text/html; charset=windows-1251">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="scripts/jquery.tablesorter.js"></script>
</head>
<body>
	<script type="text/javascript"> 
		$(document).ready(function(){ 
                        $("#mytable").tablesorter({
				headers: { 0: { sorter: \'rating\'} },
				sortList: [[0,0]]
			}); 
                }); 
	</script>

	<nav id="topNav">
		<ul>
       		<li><a href="/">Поиск</a></li>
		<li><a href="bottom.html">Bottom 250</a></li>
		</ul>
	</nav>

	<div class="title">250 лучших фильмов по версии VSFC</div>
	<div class="date">Обновлен ';
	echo date("d/m/Y");
	echo '
	</div><div class="my">
	<table id="mytable" class="tablesorter" align=center width="100%">
		<thead><tr>
			<th width=10%><center><b>Место</b></center></th>
			<th><center><b>Название</b></center></th>
			<th width=10%><center><b>Год</b></center></th>
			<th width=10%><center><b>Комм.</b></center></th>
			<th width=10%><center><b>Балл</b></center></th>
			<th width=10%><center><b>Голосов</b></center></th>
		</tr></thead>
		<tbody>
';

$h=file("top.txt");
$old=file("top-old.txt");

foreach ($h as $str){
	$outMass=explode(":",$str);
	//определяем изменение позиции в рейтинге
	$up=0;
	foreach ($old as $str1){
		$oldMass=explode(":",$str1);
		if ($outMass[3]==$oldMass[3]){
			$new=false;
			$up=(int)$oldMass[0]-(int)$outMass[0];		
			//$oldMass[0].":".$outMass[0];
			break;
		}
		$new=true;
	}
	echo '<tr><td id="num">';
	if ($new==true) echo $outMass[0] . '<sup><font color=deepskyblue><b>new</b></font></sup>';
	if ($up>0) echo $outMass[0] . '<sup><font color=green>+'.$up.'</font></sup>';
	if ($up<0) echo $outMass[0] . '<sup><font color=red>'.$up.'</font></sup>';
	if ($up==0&&$new==false) echo $outMass[0];
	
	echo '</td><td><a href="http://vkontakte.ru/'.$outMass[3].'" target="_blank">'.$outMass[1].'</a></td>';
	echo '<td><center>'.$outMass[2].'</center></td>';
	echo '<td><center>'.$outMass[4].'</center></td>';
	echo '<td><center>'.$outMass[6].'</center></td>';
	echo '<td><center>'.$outMass[5].'</center></td></tr>';
	
}

echo '
</tbody>
</table>
</div>
</body>
</html>
';
?>