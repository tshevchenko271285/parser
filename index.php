<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Parser as TZ</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body ng-app="parserApp" ng-controller="ParserCtrl">
	<div class="container">
	<span class="glyphicon glyphicon-refresh btn-refresh" aria-hidden="true" ng-click="getInventory()"></span>
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
	
				<tr ng-repeat="item in userinventory">
					<td>{{item['name']}}</td>
					<td>{{item['cena']}}</td>
					<td>{{item['cnt']}}</td>
					<td>{{item['date']}}</td>
				</tr>
	  
			</tbody>

		</table>
	</div>

<script src="js/angular.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>
