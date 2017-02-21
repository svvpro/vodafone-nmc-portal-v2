app.controller('ContactCtrl', function($scope, $http){
    var postf = 'contact';

    // Сортировка по умолчанию по фамилии, поле "suername"
    $scope.orderProp = 'surname';

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

    $scope.selectDepartament = function() {
        $scope.departaments();
    }
    

});

