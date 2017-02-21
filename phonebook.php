<?php
require_once "lib/ingener_contact_class.php";
require_once "lib/database_class.php";
?>
<?php include("partials/head.php"); ?>
<?php include("partials/navigation.php"); ?>

<div class="col-md-12 statistic-input-margin" ng-controller="ContactCtrl">
    <div class="row well">
        <h3><b>Контакты</b></h3>
        <div class="col-md-12 inner-border">
              <contact-selection-form></contact-selection-form>
        </div>
    </div>
    <div class="row well">
        <div class="col-md-12 inner-border" ng-init="getAllRecords()">
            <contact-list></contact-list>
        </div>
    </div>
</div>

<?php include("partials/bottom.php"); ?>
<script src="js/filters/filters.js"></script>
<script src="js/controllers/ingener_contact_controller.js"></script>
<script src="js/controllers/ingener_departament_controller.js"></script>
</body>
</html>