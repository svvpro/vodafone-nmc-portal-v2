<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/servicecode_description_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>Редактор "причин окончания"</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="ServiceCodeDescriptionCtrl">
    <?php include("partials/menu.php"); ?>
    <h1>Редактор "причин окончания"</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <servicecode-description-edit-form></servicecode-description-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <servicecode-description-edit-list></servicecode-description-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/servicecode_description_controller.js"></script>
</body>
</html>