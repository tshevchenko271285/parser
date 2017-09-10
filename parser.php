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

//	Готовим массив с данными для отображения, на основании ответа от сервера
$data = [];
$data_not_name = [];
for($i=0; $i<count($res); $i++) {

	//Если нет названия оружия сохраняем в отдельный массив.
	if(empty($res[$i]->d)) {
		$data_not_name[$i]['name'] = $res[$i]->d."Нет имени. Оружие типа: ".$res[$i]->t;
		$data_not_name[$i]['cena'] = (float) trim(strip_tags($res[$i]->v));
		$data_not_name[$i]['cnt'] = 1;
		$data_not_name[$i]['date'] = date('Y-n-d G:i:s');
		continue;
	}
	
	// Если название оружия число(индекс), тогда увеличиваем 
	// колличество этого оружия обращаясь по индексу.
	if(is_int($res[$i]->d)){
		$data[$res[$i]->d]['cnt']++;
		continue;
	}
	
	//Сохраняем необходимые данные
	$data[$i]['name'] = trim(strip_tags($res[$i]->d));
	$data[$i]['cena'] = (float) trim(strip_tags($res[$i]->v));
	$data[$i]['cnt'] = 1;
	$data[$i]['date'] = date('Y-n-d G:i:s');
}

header('Content-type: application/json; charset=utf8');
echo json_encode($data);