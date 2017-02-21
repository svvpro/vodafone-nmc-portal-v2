<?php
require_once "lib/alarm_active_class.php";
require_once "lib/alarm_archive_class.php";
require_once "lib/alarm_template_class.php";
require_once "lib/database_class.php";
?>

<?php include("partials/head.php"); ?>
<?php include("partials/navigation.php"); ?>
        <div  class="col-md-8 statistic-input-margin" style="width: 65.6%; margin-right: 15px">
            <div class="row well" ng-controller="AlarmCtrl" >
                <h3><b>РЕДАКТОР АВАРИЙ</b></h3>
                <div id="editor"  class="col-md-12 inner-border inner-margin-bottom">
                    <alarm-edit-result></alarm-edit-result>
                </div>

                <div class="col-md-12 inner-border">
                    <alarm-edit-form></alarm-edit-form>
                </div>
            </div>

            <div class="row well" ng-controller="AlarmTemplateCtrl">
                <h3><b>ПОИСК ШАБЛОНА</b></h3>
                <div ng-init="getAllRecords()">
                    <alarm-template-selection-form></alarm-template-selection-form>
                    <alarm-template-list></alarm-template-list>
                </div>
            </div>
        </div>
        <div class="col-md-4 statistic-input-margin well" style="min-height: 100%">
            <h3><b>АКТИВНЫЕ АВАРИИ</b></h3>
            <div class="col-md-12 inner-border" >
                <active-alarm-list ng-controller="AlarmCtrl"  ng-init="getAllRecords()"></active-alarm-list>
            </div>
        </div>


<?php include("partials/bottom.php"); ?>
<script src="js/filters/filters.js"></script>
<script src="js/controllers/alarm_controller.js"></script>
<script src="js/controllers/alarm_template_controller.js"></script>
</body>
</html>