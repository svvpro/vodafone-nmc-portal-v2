app.controller('ServiceCodeDescriptionCtrl', function($scope, $http){
    var postf = 'servicecode_description';

    // Сортировка по умолчанию по сервис коду, поле "code_id"
    $scope.orderProp = 'code_id';

    $scope.getAllRecords = $scope.getAll(postf);

    $scope.addRecord = function(){
        $scope.addData($scope.formData, postf);
    }

    $scope.editRecord = function(id){
        $scope.editData(id, postf);
    }

    $scope.updateRecord = function(){
        $scope.updateData($scope.formData, postf);
    }

    $scope.deleteRecord = function(id){
        $scope.deleteData(id, postf);
    }

    $scope.resetForm = function(){
        $scope.reset();
    }

    $scope.selectServiceCodeType = function() {
        $scope.serviceCodeType();
    }


});
