<!doctype html>
<html lang="ru" ng-app="alarm">
<?php
require_once "../lib/ingener_contact_class.php";
require_once "../lib/database_class.php";
?>
<head>
    <meta charset="UTF-8">
    <title>NMC Portal</title>
    <?php include("partials/head.php"); ?>
</head>
<body ng-controller="BaseCtrl">
<div class="container" ng-controller="ContactCtrl">
    <?php include("partials/menu.php"); ?>
    <h2>Редактор контактов</h2>
    <div class="row well">
        <div class="col-md-6 col-md-offset-3">
            <contact-edit-form></contact-edit-form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 well" ng-init="getAllRecords()">
            <alert-message></alert-message>
            <contact-edit-list></contact-edit-list>
        </div>
    </div>
</div>
<?php include("../admin/partials/bottom.php"); ?>

<script src="../js/controllers/ingener_contact_controller.js"></script>
<script src="../js/controllers/ingener_departament_controller.js"></script>
</body>
</html>