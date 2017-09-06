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

	$data[$i]['name'] = trim(strip_tags($res[$i]->d));
	$data[$i]['cena'] = (float) trim(strip_tags($res[$i]->v));
	$data[$i]['cnt'] = 1;
	$data[$i]['date'] = date('Y-n-d G:i');
	
	if(empty($data[$i]['name'])) {
		$data[$i]['name'] = "Нет имени. Оружие типа: ".$res[$i]->t;
	}
	
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parser as TZ</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<a href="http://<?= $_SERVER['SERVER_NAME'] ?>">Обновить</a>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Оружие</th>
					<th>Цена</th>
					<th>На складе</th>
					<th>Дата</th>
				</tr>
			</thead>
			<tbody>
	  
				<? foreach($data as $item) { ?>
	
				<tr>
					<td><?= $item['name'] ?></td>
					<td><?= $item['cena'] ?></td>
					<td><?= $item['cnt'] ?></td>
					<td><?= $item['date'] ?></td>
				</tr>
	  
				<? } ?>
	  
			</tbody>
		</table>
	</div>
</body>
</html>
