<?php
require_once "lib/alarm_archive_class.php";
require_once "lib/database_class.php";
?>
<?php include("partials/head.php"); ?>
<?php include("partials/navigation.php"); ?>


<div ng-controller="DateTimePickerCtrl">
<div class="col-md-12 statistic-input-margin" ng-controller="ArchiveCtrl">
    <div class="row well" ng-init="reloadData()">
        <h3><b>Статистика</b></h3>
        <div class="col-md-12 inner-border" >
            <alarm-archive-dashboard></alarm-archive-dashboard>
        </div>
    </div>
    <div class="row well">

        <div class="col-md-12 inner-border">
            <label>
                <a data-toggle="collapse" href="#collapse1" class="colapse">ОТОБРАЗИТЬ\СКРЫТЬ ГРАФИКИ <i class="fa fa-sort" aria-hidden="true"></i></a>
            </label>

            <alarm-archive-charts id="collapse1" class="collapse"></alarm-archive-charts>
        </div>
    </div>

    <div class="row well">
        <div class="col-md-12 inner-border" ng-init="getAllRecords()">
            <alarm-archive-list></alarm-archive-list>
        </div>
    </div>
</div>
</div>
<?php include("partials/bottom.php"); ?>
<script src="js/controllers/DateTimePickerCtrl.js"></script>
<script src="js/filters/filters.js"></script>
<script src="js/controllers/alarm_archive_controller.js"></script>

</body>
</html>