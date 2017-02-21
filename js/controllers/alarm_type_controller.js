app.controller('TypeCtrl', function($scope, $http){
    var postf = 'type';

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

    $scope.selectCategory = function() {
        $scope.сategory();
    }
});