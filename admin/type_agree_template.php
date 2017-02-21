<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/alarm_type_agree_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="TypeAgreeCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор типов согласования шаблона</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <type-agree-edit-form></type-agree-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <type-agree-edit-list></type-agree-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/alarm_type_agree_controller.js"></script>
</body>
</html>
