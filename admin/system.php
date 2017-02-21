<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_system_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="SystemCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор типов систем</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <system-edit-form></system-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <system-edit-list></system-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/alarm_system_controller.js"></script>
</body>
</html>
