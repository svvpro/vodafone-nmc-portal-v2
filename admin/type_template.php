<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_type_template_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="TypeTemplateCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор типов шаблона</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <type-template-edit-form></type-template-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <type-template-edit-list></type-template-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/type_template_controller.js"></script>
</body>
</html>