<?php
$url = 'http://ru.cs.deals/ajax/botsinventory';
$opts = array(
	'http'=>array(
		'method' => "POST",
		'header' => "Referer: http://ru.cs.deals\r\n".
					"X-Requested-With: XMLHttpRequest\r\n"
	)
);

$context = stream_context_create($opts);

$file = file_get_contents($url, false, $context);
$res = json_decode($file);
$res = $res->response;

header('Content-type: text/html; charset=utf8');


//	Готовим массив с данными для отображения, на основании ответа от сервера

$data = [];

for($i=0; $i<count($res); $i++) {
	
	if(is_int($res[$i]->d)){
		$data[$res[$i]->d]['cnt']++;
		continue;
	}
	//Сохраняем необходимые данные
	$data[$i]['name'] = trim(strip_tags($res[$i]->d));
	$data[$i]['cena'] = (float) trim(strip_tags($res[$i]->v));
	$data[$i]['cnt'] = 1;
	$data[$i]['date'] = date('Y-n-d G:i:s');
	
	if(empty($data[$i]['name'])) {
		$data[$i]['name'] = "Нет имени. Оружие типа: ".$res[$i]->t;
	}

}
echo json_encode($data);

