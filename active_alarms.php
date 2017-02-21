<?php
require_once "lib/alarm_active_class.php";
require_once "lib/database_class.php";
?>
<!DOCTYPE html >
<html lang="ru" ng-app="alarm">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>NMC Portal</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

	<link rel="stylesheet" href="bower_components/angular-ui-bootstrap-datetimepicker/datetimepicker.css">

	<!--    Font-Awesome-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

	<!--    My css style file-->
	<link rel="stylesheet" href="css/main.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/demo.css" />
	<link rel="stylesheet" href="css/component.css" />

	<script src="js/lib/modernizr.custom.js"></script>
	<script src="bower_components/angular/angular.js"></script>

	<!--    Export tp Excel-->
	<script src="https://rawgithub.com/eligrey/FileSaver.js/master/FileSaver.js" type="text/javascript"></script>

</head>
<body ng-controller="BaseCtrl" ng-cloak>
	<div  ng-controller="AlarmCtrl" class="table-alarms" >
		<h3><b>АКТИВНЫЕ АВАРИИ</b></h3>
		<table style="width: 100%" ng-repeat="item in activeAlarmItems | orderBy: 'next_status'"
				class="alert alert-dismissible alert-success border-success col-md-12"
				ng-class="{'alert alert-dismissible alert-warning border-warning':((item.next_status | toUnixTime) - currentUnixDateTime) < 1800  && ((item.next_status | toUnixTime) - currentUnixDateTime)  > 900, 'alert alert-dismissible alert-danger border-critical' : ((item.next_status | toUnixTime) - currentUnixDateTime) <= 900}"
				ng-click="editRecord(item.id)">
			<tr style="border-bottom: 5px solid">
				<td colspan="2">

					<h4>{{ item.text.substr(0,100)+'...'}}</h4>
				</td>
			</tr>
			<tr>
				<td style="width: 200px">
					<strong>Система: </strong>{{ item.system }} <br>
					<strong>Категория: </strong>{{ item.category.replace("Статус","") }} <br>
					<strong>Part: </strong>{{ item.part }}
				</td>
				<td>
					<strong>До следующего статуса: </strong> <br>
					<timer end-time="item.next_status" class="timer"><h1><strong>{{days}}д : {{hours}}ч : {{minutes}}м : {{seconds}}с</strong></h1></timer>
				</td>
			</tr>
		</table>
	</div>

	<!--Timer-->
	<script src="bower_components/momentjs/min/moment.min.js"></script>
	<script src="bower_components/humanize-duration/humanize-duration.js"></script>

	<script src="bower_components/angular-timer/dist/angular-timer.js"></script>

	<!--Angular-filter-->
	<script src="bower_components/angular-filter/dist/angular-filter.min.js"></script>

	<!--    Multiselect-->
	<script src="bower_components/oi.select/dist/select-tpls.min.js"></script>
	<!--Date-Time picker-->
	<script src="bower_components/angular-ui-bootstrap-datetimepicker/datetimepicker.js"></script>
	<script src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
	<!--Angular Animate-->
	<script src="bower_components/angular-animate/angular-animate.js"></script>

	<!--    JS library moment-->
	<script src="bower_components/moment/moment.js"></script>
	<script src="bower_components/momentjs/min/locales.min.js"></script>
	<script src="bower_components/moment-timezone/builds/moment-timezone-with-data-2010-2020.js"></script>
	<!--    Pagination-->
	<script src="bower_components/angularUtils-pagination/dirPagination.js"></script>

	<script src="bower_components/jquery/dist/jquery.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<!--    Application sctipts-->
	<script src="js/modules/module.js"></script>
	<script src="js/controllers/base_controller.js"></script>
	<script src="js/directives/directives.js"></script>
	<!--Charts-->
	<script type="text/javascript" src="js/lib/fusioncharts.js"></script>
	<script type="text/javascript" src="js/lib/fusioncharts.charts.js"></script>
	<script type="text/javascript" src="js/lib/angular-fusioncharts.min.js"></script>
	<!--NgClipboard-->
	<script src="bower_components/clipboard/dist/clipboard.min.js"></script>
	<script src="bower_components/ngclipboard/dist/ngclipboard.min.js"></script>

	<script src="js/filters/filters.js"></script>
	<script src="js/controllers/alarm_controller.js"></script>
	<script src="js/controllers/alarm_template_controller.js"></script>

</body>
</html>