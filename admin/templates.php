<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_template_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NNC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="AlarmTemplateCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор шаблонов</h2>
    <div class="row well">
        <div class="col-md-6 col-md-offset-3">
            <alarm-template-edit-form></alarm-template-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <alarm-template-edit-list></alarm-template-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/alarm_template_controller.js"></script>
</body>
</html>