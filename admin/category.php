<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_category_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="CategoryCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор типов каатегорий</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <category-edit-form></category-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <category-edit-list></category-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/alarm_category_controller.js"></script>
</body>
</html>