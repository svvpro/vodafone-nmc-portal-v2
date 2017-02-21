app.controller('ArchiveCtrl', function($scope, $http, $timeout, $filter) {

    var postf = 'archive';

    $scope.getAllArchiveRecords = $scope.getAll(postf);

    $scope.addRecord = function () {
        $scope.addData($scope.formData, postf);
    }

    $scope.editRecord = function (id) {
        // $scope.editData(id, postf);
        $http.post("/routs.php?action=edit_archive", {'id': id})
            .success(function(data, status, headers, config){
                $scope.formData.id = data["id"];
                $scope.formData.category_id = data["category_id"];
                $scope.formData.system_id = data["system_id"];
                $scope.formData.comment = data["comment"];
                $scope.formData.text_open = data["text_open"];
                $scope.formData.text_close = data["text_close"];
                $scope.formData.date_open = new Date(moment(data["date_open"]).format());
                $scope.formData.date_close = new Date(moment(data["date_close"]).format());
                $scope.formData.addButton = false;
                $scope.formData.updateButton = true;

            }).error(function(data, status, headers, config){});
    }

    $scope.updateRecord = function () {
        var date_open = $scope.formData.date_open;
        var timezone_date_open = $filter('date')(date_open, 'yyyy-MM-ddTHH:mm:ss');

        var date_close = $scope.formData.date_close;
        var timezone_date_close = $filter('date')(date_close, 'yyyy-MM-ddTHH:mm:ss');

        $http.post("/routs.php?action=update_archive", {
            'id': $scope.formData.id,
            'system_id': $scope.formData.system_id,
            'category_id': $scope.formData.category_id,
            'comment': $scope.formData.comment,
            'text_open': $scope.formData.text_open,
            'text_close': $scope.formData.text_close,
            'date_open': timezone_date_open,
            'date_close': timezone_date_close})
            .success(function(data, status, headers, config){
                $scope.openClose();
                $scope.nextStatus();
                $scope.getAll(postf);
            }).error(function(data, status, headers, config){});
    }

    $scope.deleteRecord = function (id) {
        $scope.deleteData(id, postf);
    }

    $scope.resetForm = function () {
        $scope.reset();
    }

    $scope.selectSystem = function () {
        $scope.systems();
    }

    $scope.selectCategory = function () {
        $scope.сategory();
    }

    // $scope.selectTypeCategory = function () {
    //     $scope.typeCategory();
    // }



    var date = new Date();
    var year = date.getFullYear();
    $scope.from = new Date(moment(year + '-01-01T00:00:00').format());
    $scope.to = new Date(moment().local());

    $scope.getArchiveByDateRange = function () {
        var from = $scope.from;
        var timezone_from = $filter('date')(from, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        var to = $scope.to;
        var timezone_to= $filter('date')(to, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        $http.post("/routs.php?action=post_archive", {'from': timezone_from, 'to': timezone_to}).success(function (data) {
            $scope.pageRangeItems = data;
        });
    }

    $scope.reloadData = function(){
            $scope.none = false;
            $scope.getArchiveByDateRange();
            $scope.getSystemChart();
            $scope.getCategoryChart();
            // $scope.getYearChart();
            $scope.reloadCharts();
    }

    $scope.reloadCharts =  function(){
        angular.element(document).ready(function () {
            $timeout(function(){
                $scope.none = true;
            },500);
        });
    }


    $scope.getSystemChart = function () {
        var from = $scope.from;
        var timezone_from = $filter('date')(from, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        var to = $scope.to;
        var timezone_to= $filter('date')(to, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        $http.post("/routs.php?action=system_chart", {'from': timezone_from, 'to': timezone_to}).success(function (data) {
            var systemChartItems = {};
            systemChartItems.data = data;
            $scope.systemChartItems = systemChartItems;
        });
    }

    $scope.getCategoryChart = function () {
        var from = $scope.from;
        var timezone_from = $filter('date')(from, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        var to = $scope.to;
        var timezone_to= $filter('date')(to, 'yyyy-MM-ddTHH:mm:ss').replace('T', ' ');

        $http.post("/routs.php?action=category_chart", {'from': timezone_from, 'to': timezone_to}).success(function (data) {
            var categoryChartItems = {};
            categoryChartItems.data = data;
            $scope.categoryChartItems =  categoryChartItems;
        });
    }

    $scope.getYearChart = function () {
        $http.post("/routs.php?action=year_chart").success(function (data) {
            $scope.yearResult = JSON.parse(data);
        });
    }

    $scope.none = false;


    $scope.chartAttrs = {
        "pieRadius": "200"
    };

    $scope.exportData = function () {

        var from = $scope.from;
        var timezone_from = $filter('date')(from, 'yyyy-MM-dd');

        var to = $scope.to;
        var timezone_to= $filter('date')(to, 'yyyy-MM-dd');

        var blob = new Blob([document.getElementById('exportable').innerHTML], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8"
        });
        saveAs(blob, "Alarm_report_"+timezone_from+"_"+timezone_to+".xls");
    };


    // $scope.testChart = {
    //     "chart": {
    //         "theme": "fint",
    //             "caption": "Количество аварий за год",
    //             "subCaption": "по месяцам",
    //             "xAxisname": "Категории",
    //             "yAxisName": "Количество аварий",
    //     },
    //     "categories": [
    //         {
    //             "category": [
    //                 {
    //                     "label": "Январь"
    //                 },
    //                 {
    //                     "label": "Февраль"
    //                 },
    //                 {
    //                     "label": "Март"
    //                 },
    //                 {
    //                     "label": "Апрель"
    //                 },
    //                 {
    //                     "label": "Май"
    //                 },
    //                 {
    //                     "label": "Июнь"
    //                 },
    //                 {
    //                     "label": "Июль"
    //                 },
    //                 {
    //                     "label": "Август"
    //                 },
    //                 {
    //                     "label": "Сентябрь"
    //                 },
    //                 {
    //                     "label": "Октябрь"
    //                 },
    //                 {
    //                     "label": "Ноябрь"
    //                 },
    //                 {
    //                     "label": "Декабрь"
    //                 },
    //             ]
    //         }
    //     ],
    //     "dataset": [
    //         {
    //             "seriesname": "Предаварийное информирование",
    //             "data": [
    //                 {
    //                     "value": 10
    //                 },
    //                 {
    //                     "value": 15
    //                 },
    //                 {
    //                     "value": 10
    //                 },
    //                 {
    //                     "value": 15
    //                 }
    //             ]
    //         },
    //         {
    //             "seriesname": "Предаварийная ситуация",
    //             "data": [
    //                 {
    //                     "value": 11
    //                 },
    //                 {
    //                     "value": 14
    //                 },
    //                 {
    //                     "value": 30
    //                 },
    //                 {
    //                     "value": 10
    //                 }
    //             ]
    //         },
    //         {
    //             "seriesname": "3-я категория",
    //             "data": [
    //                 {
    //                     "value": 10
    //                 },
    //                 {
    //                     "value": 18
    //                 },
    //                 {
    //                     "value": 0
    //                 },
    //                 {
    //                     "value": 1
    //                 }
    //             ]
    //         },
    //         {
    //             "seriesname": "2-я категория",
    //             "data": [
    //                 {
    //                     "value": 11
    //                 },
    //                 {
    //                     "value": 14
    //                 },
    //                 {
    //                     "value": 8
    //                 },
    //                 {
    //                     "value": 11
    //                 }
    //             ]
    //         },
    //         {
    //             "seriesname": "1-я категория",
    //             "data": [
    //                 {
    //                     "value": 10
    //                 },
    //                 {
    //                     "value": 14
    //                 },
    //                 {
    //                     "value": 13
    //                 },
    //                 {
    //                     "value": 18
    //                 }
    //             ]
    //         }
    //
    //     ]
    // }

});

// app.directive('onFinishRender', function ($timeout) {
//     return {
//         restrict: 'A',
//         link: function (scope, element, attr) {
//             if (scope.$last === true) {
//                 $timeout(function () {
//                     scope.$emit('ngRepeatFinished');
//                 });
//             }
//         }
//     }
// });

