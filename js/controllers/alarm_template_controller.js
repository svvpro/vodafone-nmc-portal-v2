app.controller('AlarmTemplateCtrl', function($scope, $http){
    var postf = 'template';

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


    $scope.selectSystem = function() {
        $scope.systems();
    }

    $scope.selectTypeTemplate = function() {
        $scope.typeTemplate();
    }

    $scope.selectTypeAgree = function() {
        $scope.typeAgreeTemmlate();
    }
    
});