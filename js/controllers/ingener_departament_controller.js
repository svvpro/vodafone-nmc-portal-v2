app.controller('DepartCtrl', function($scope){
	var postf = 'depart';
	
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
});

