<?php
date_default_timezone_set('Europe/Moscow');
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8;');
$fp = file("bestfilms");

		
function getusers($fp){
	$n=0;
	foreach ($fp as $str) {
		$arr= explode(":", $str);
		$names[$n]=$arr[0];
		$n++;
	}
	$names=array_unique($names);
	sort($names);
	foreach ($names as $name){
		$out="<tr><td id=\"name\">".$name."</td></tr>\n";
		echo iconv("cp1251","UTF-8",$out);
	}
}

function getmovies($fp,$name) {
	$n=0;
	foreach ($fp as $str) {
		$arr= explode(":", $str);
		if ($arr[0]==iconv("UTF-8","cp1251",$name)){
			$movies[$n]=$arr[1];
			$link[$n]=$arr[2];
			$n++;
		}		
	}
	
	$n=0;
	foreach ($movies as $movie){
		$link1="http://vk.com/".$link[$n];
		$out="<tr><td id=\"movie\"><a href=\"#\" onclick=\"window.open('".trim($link1)."');\">".$movie."</td></tr>\n";
		echo iconv("cp1251","UTF-8",$out);
		$n++;
	}

}


if ($_POST["s"]=="users"){
	getusers($fp);
	return;
}

if ($_POST["s"]=="movies"&&isset($_POST["name"])){
	getmovies($fp,$_POST["name"]);
	return;
}
                         

?>