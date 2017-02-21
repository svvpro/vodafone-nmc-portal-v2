<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_archive_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="ArchiveCtrl">
    <?php include("partials/menu.php"); ?>
    <div class="row">
        <h2>Редактор архива аварий</h2>
        <div class="col-md-12 well">
            <alarm-archive-edit-form></alarm-archive-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 well" ng-init="getAllArchiveRecords()">
            <alert-message></alert-message>
            <alarm-archive-edit-list></alarm-archive-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>
<script src="../js/filters/filters.js"></script>
<script src="../js/controllers/alarm_archive_controller.js"></script>
</body>
</html>