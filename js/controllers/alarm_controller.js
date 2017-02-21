app.controller('AlarmCtrl', function($scope, $http, $filter,$timeout) {
    var postf = 'alarm';


   $scope.getAllRecords = $scope.getAllAlarms(postf);

    $scope.watchAlarm = function(){
        $timeout(function () {
            $http.get("/routs.php?action=get_alarm").success(function (data) {
                $scope.activeAlarmItems = data;
            });
            $scope.watchAlarm();
        }, 1000);
    };
    $scope.watchAlarm();


    $scope.$watch("formData.type_id", function () {

        if("formData.type_id" !==undefined) {
            if ($scope.formData.type_id == 4 || $scope.formData.type_id == 10 || $scope.formData.type_id == 15|| $scope.formData.type_id == 20) {
                $scope.formData.addButton = false;
                $scope.formData.updateButton = false;
                $scope.formData.deleteButton = true;
                $scope.formData.open_close_visible = true;
                $scope.formData.status_visible = false;
                $scope.formData.part_visible = false;
                $scope.formData.status_close = "Время закрытия аварии:";
            } else if ($scope.formData.type_id == 3 || $scope.formData.type_id == 9 || $scope.formData.type_id == 14 || $scope.formData.type_id == 19) {
                $scope.formData.addButton = false;
                $scope.formData.updateButton = true;
                $scope.formData.deleteButton = false;
                $scope.formData.open_close_visible = false;
                $scope.formData.status_visible = true;
                $scope.formData.part_visible = true;
            } else if ($scope.formData.type_id == 2 || $scope.formData.type_id == 8 || $scope.formData.type_id == 13 || $scope.formData.type_id == 18 ) {
                $scope.formData.addButton = true;
                $scope.formData.updateButton = false;
                $scope.formData.deleteButton = false;
                $scope.formData.open_close_visible = true;
                $scope.formData.status_visible = true;
                $scope.formData.status_close = "Время открытия аварии:";
                $scope.formData.part_visible = false;
            } else if ($scope.formData.type_id == 5 ||
                        $scope.formData.type_id == 6||
                        $scope.formData.type_id == 7 ||
                        $scope.formData.type_id == 11 ||
                        $scope.formData.type_id == 12 ||
                        $scope.formData.type_id == 16 ||
                        $scope.formData.type_id == 16 ||
                        $scope.formData.type_id == 17 ||
                        $scope.formData.type_id == 21 ||
                        $scope.formData.type_id == 22) {
                $scope.formData.addButton = false;
                $scope.formData.updateButton = true;
                $scope.formData.deleteButton = false;
                $scope.formData.open_close_visible = true;
                $scope.formData.status_visible = true;
                $scope.formData.status_close = "Время изменения категории аварии:";
                $scope.formData.part_visible = false;
            }else{
            }
        }
    });

    $scope.$watch("formData.type_id", function(){

            if($scope.formData.type_id !=="") {
                $http.post("/routs.php?action=get_alarm_by_id", {'id': $scope.formData.type_id})
                    .success(function (data, status, headers, config) {
                        if(data.title.indexOf('Статус') > 0){
                            $scope.formData.alarmTitle = data.title + ' Part' + $scope.formData.part;
                        }else{
                            $scope.formData.alarmTitle = data.title;
                        }
                        $scope.mail = data.mail;
                        $scope.category_id = data.category_id;
                        $scope.lengthTitle = $scope.formData.alarmTitle.length;
                    }).error(function (data, status, headers, config) {
                });
            }
    });



    $scope.addRecord = function () {
        var ingener = angular.toJson($scope.formData.ingener);

        var dt = $scope.formData.open_close;
        var timezone_open_close = $filter('date')(dt, 'yyyy-MM-ddTHH:mm:ss');

        var dt1 = $scope.formData.next_status;
        var timezone_next_status = $filter('date')(dt1, 'yyyy-MM-ddTHH:mm:ss');


        $http.post("/routs.php?action=add_alarm", {
            'text': $scope.formData.text,
            'system_id': $scope.formData.system_id,
            'type_id': $scope.formData.type_id,
            'ingener': ingener,
            'category_id': $scope.category_id,
            'next_status': timezone_next_status,
            'open_close': timezone_open_close})
            .success(function(data, status, headers, config){
                $scope.openClose();
                $scope.nextStatus();
                $scope.getAllAlarms(postf);
            }).error(function(data, status, headers, config){});
    }


    $scope.insertTemplate = function(alarm) {
        $scope.formData.text = alarm;
    }

    $scope.editRecord = function (id) {
        // $scope.editData(id, postf);

        $http.post("/routs.php?action=edit_alarm", {'id': id})
            .success(function(data, status, headers, config){
                var ingener = JSON.parse(data[0]["ingener"]);
                $scope.formData.ingener = ingener;
                var system_id = Number(data[0]["system_id"]);
                var type_id = Number(data[0]["type_id"]);
                $scope.formData.system_id = system_id.toString();
                $scope.formData.text = data[0]["text"];
                $scope.formData.close_id = data[0]["close_id"];
                $scope.formData.part = (data[0]["part"] + 1);
                $scope.formData.id = data[0]["id"];
                $scope.formData.type_id = type_id.toString();
                $scope.formData.next_status = new Date(moment(data[0]["next_status"]).format());
                $scope.formData.addButton = false;
                $scope.formData.updateButton = true;
                if($scope.formData.type_id == 2){
                    $scope.formData.type_id = "3";
                    $scope.formData.addButton = false;
                    $scope.formData.updateButton = true;
                }else if($scope.formData.type_id == 8){
                    $scope.formData.type_id = "9";
                    $scope.formData.addButton = false;
                    $scope.formData.updateButton = true;
                }
                else if($scope.formData.type_id == 13){
                    $scope.formData.type_id = "14";
                    $scope.formData.addButton = false;
                    $scope.formData.updateButton = true;
                }
                else if($scope.formData.type_id == 18) {
                    $scope.formData.type_id = "19";
                    $scope.formData.addButton = false;
                    $scope.formData.updateButton = true;
                }
            }).error(function(data, status, headers, config){});

    }

    $scope.updateRecord = function () {

        var ingener = angular.toJson($scope.formData.ingener);


        var open_close = $scope.formData.open_close;
        var timezone_open_close = $filter('date')(open_close, 'yyyy-MM-ddTHH:mm:ss');

        var next_status = $scope.formData.next_status;
        var timezone_next_status = $filter('date')(next_status, 'yyyy-MM-ddTHH:mm:ss');

        $http.post("/routs.php?action=update_alarm", {
            'id': $scope.formData.id,
            'text': $scope.formData.text,
            'system_id': $scope.formData.system_id,
            'type_id': $scope.formData.type_id,
            'close_id': $scope.formData.close_id,
            'part':  $scope.formData.part,
            'ingener': ingener,
            'category_id': $scope.category_id,
            'next_status': timezone_next_status,
            'open_close': timezone_open_close})
            .success(function(data, status, headers, config){
                $scope.openClose();
                $scope.nextStatus();
                $scope.getAllAlarms(postf);
            }).error(function(data, status, headers, config){});
    }

    $scope.deleteRecord = function () {
        var dt = $scope.formData.open_close;
        var timezone_open_close = $filter('date')(dt, 'yyyy-MM-ddTHH:mm:ss');
        $http.post("/routs.php?action=delete_alarm", {
            'id': $scope.formData.id,
            'text': $scope.formData.text,
            'system_id': $scope.formData.system_id,
            'category_id': $scope.category_id,
            'date_close': timezone_open_close,
            'close_id': $scope.formData.close_id
            })
            .success(function(data, status, headers, config){
                $scope.getAllAlarms(postf);
            }).error(function(data, status, headers, config){
        });
    }

    $scope.resetForm = function () {
        $scope.reset();
    }

    $scope.$watchGroup(['formData.text', 'lengthTitle'], function() {
        $scope.count_symbol_without_subject = 0;
        $scope.count_symbol = 0;
        var count_text = ($scope.formData.text).replace(/(<([^>]+)>)/ig," ");
        $scope.count_symbol_without_subject = count_text.length;
        if($scope.lengthTitle){
            $scope.count_symbol = count_text.length + $scope.lengthTitle;
        }else{
            $scope.count_symbol = count_text.length ;
        }
    });

    $scope.TranslateRusUkr = function(){
        var text = $scope.formData.text;
        var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160919T104659Z.d5ab0586257f19d5.9c7246b32d4b3e801c88cb8a2b1638f71ab3f2da&text='+text+'&lang=ru-uk&format=html, data,config';
        $http.post(url)
            .success(function (data, status, headers, config) {
                $scope.formData.text = data.text;
                $scope.formData.text = $scope.formData.text + '';
            })
            .error(function (data, status, header, config) {
            });
    };

    $scope.TranslateUkrRus = function(){
        var text = $scope.formData.text;
        var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160919T104659Z.d5ab0586257f19d5.9c7246b32d4b3e801c88cb8a2b1638f71ab3f2da&text='+text+'&lang=uk-ru&format=html, data,config';
        $http.post(url)
            .success(function (data, status, headers, config) {
                $scope.formData.text = data.text;
                $scope.formData.text = $scope.formData.text + '';
            })
            .error(function (data, status, header, config) {
            });
    };


    $scope.selectSystem = function() {
        $scope.systems();
    }

    $scope.selectTypeCategory = function() {
        $scope.typeCategory();
    }

    $scope.selectContact = function() {
        $scope.contacts();
    }
});