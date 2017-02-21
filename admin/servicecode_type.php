<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/servicecode_type_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>Редактор типов прин окончания</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="ServiceCodeTypeCtrl">
    <?php include("partials/menu.php"); ?>
    <h1>Редактор типов "причин окончания"</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <servicecode-type-edit-form></servicecode-type-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <servicecode-type-edit-list></servicecode-type-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/servicecode_type_controller.js"></script>
</body>
</html>