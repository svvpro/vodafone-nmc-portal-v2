<?php
require_once "lib/servicecode_description_class.php";
require_once "lib/database_class.php";
?>
<?php include("partials/head.php"); ?>
<?php include("partials/navigation.php"); ?>

<div class="col-md-12 statistic-input-margin" ng-controller="ServiceCodeDescriptionCtrl">
    <div class="row well">
        <h3><b>Справочник по причинам окончания платформ MSCP</b></h3>
        <div class="col-md-12 inner-border">
            <servicecode-selection-form></servicecode-selection-form>
        </div>
    </div>
    <div class="row well">
        <div class="col-md-12 inner-border" ng-init="getAllRecords()">
            <servicecode-description-list></servicecode-description-list>
        </div>
    </div>
</div>

<?php include("partials/bottom.php"); ?>
<script src="js/filters/filters.js"></script>
<script src="js/controllers/servicecode_description_controller.js"></script>
</body>
</html>