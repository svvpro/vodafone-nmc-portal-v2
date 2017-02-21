app.controller('BaseCtrl', function($scope, $http, $timeout, dateFilter){

    $scope.getAll = function(path) {
        $http.get("/routs.php?action=get_" + path).success(function (data) {
            $scope.pageItems = data;
			$scope.reset();
        });

    }

	$scope.getAllAlarms = function(path) {
		$http.get("/routs.php?action=get_" + path).success(function (data) {
			$scope.activeAlarmItems = data;
			$scope.reset();
		});
	}
	
	$scope.addData = function(objData, postf){
        $http.post("/routs.php?action=add_" + postf, objData)
            .success(function(data, status, headers, config){
				$scope.getAll(postf);
				$scope.infoMessage("Запись успешно добавлена", true);
            }).error(function(data, status, headers, config){
				$scope.infoMessage("Ошибка добавления записи", false);
			});
	}	
	
	$scope.editData = function(id, postf){
        $http.post("/routs.php?action=edit_" + postf, {'id': id})
            .success(function(data, status, headers, config){		
				$scope.formData = data;
				$scope.formData.addButton = false;
				$scope.formData.updateButton = true;
            }).error(function(data, status, headers, config){			
			});
	}
	
	$scope.updateData = function(objData, postf){
		$http.post("/routs.php?action=update_" + postf, objData)
            .success(function(data, status, headers, config){
				$scope.getAll(postf);
				$scope.formData.addButton = true;
				$scope.formData.updateButton = false;
				$scope.infoMessage("Запись успешно обновлена", true);
            }).error(function(data, status, headers, config){
				$scope.infoMessage("Ошибка обновления записи", false);
			});
	}
	
	$scope.deleteData = function(id, postf){
        $http.post("/routs.php?action=delete_" + postf, {'id': id})
            .success(function(data, status, headers, config){
                $scope.getAll(postf);
				$scope.infoMessage("Запись успешно удалена", true);
            }).error(function(data, status, headers, config){
				$scope.getAll(postf);
				$scope.infoMessage("Ошибка удаления записи", false);
			});
    }

	$scope.reset = function(){
		$scope.formData = {};
		$scope.alarmTitle = {};
		$scope.formData.addButton = true;
		$scope.formData.updateButton = false;
		$scope.formData.deleteButton = false;
		$scope.formData.open_close_visible = true;
		$scope.formData.status_visible = true;
		$scope.formData.status_close = "Время открытия аварии:";
		$scope.formData.part_visible = false;
		$scope.openClose();
		$scope.nextStatus();
	}

	$scope.systems = function(){
		$http.get("/routs.php?action=select_system").success(function (data) {
			$scope.selectSystemItems = data;
		});
	}
	$scope.typeCategory = function () {
		$http.get("/routs.php?action=select_type_category").success(function (data) {
			$scope.selectTypeCategoryItems = data;
		});
	}
	$scope.сategory = function () {
		$http.get("/routs.php?action=select_category").success(function (data) {
			$scope.selectCategoryItems = data;
		});
	}
	$scope.contacts = function(){
		$http.get("/routs.php?action=select_contact").success(function (data) {
			$scope.selectContactItems = data;
		});
	}

	$scope.typeTemplate = function(){
		$http.get("/routs.php?action=select_type_template").success(function (data) {
			$scope.selectTypeTemplateItems = data;
		});
	}

	$scope.typeAgreeTemmlate = function(){
		$http.get("/routs.php?action=select_type_agree").success(function (data) {
			$scope.selectTypeAgreeItems = data;
		});
	}

	$scope.departaments = function(){
		$http.get("/routs.php?action=select_depart").success(function (data) {
			$scope.selectDepartamentItems = data;
		});
	}

	$scope.serviceCodeType= function(){
		$http.get("/routs.php?action=select_service_code_type").success(function (data) {
			$scope.selectServiceCodeItems = data;
		});
	}



	$scope.infoMessage = function(message, success){
		$scope.message = message;
		if(success === true){
			$scope.showSuccessMessage = true;
			$timeout(function(){
				$scope.showSuccessMessage = false;
			},
			1000);
		}else if(success === false){
			$scope.showErrorMessage = true;
			$timeout(function(){
				$scope.showErrorMessage = false;
			},
			1000);
		}else{
			
		}
	}

	$scope.openClose = function () {
		var m = new moment();
		$scope.formData.open_close = new Date(m.local());
	}

	$scope.nextStatus = function () {
		var m = new moment();
		$scope.formData.next_status = new Date(m.local());
	}

	// Сортировка по умолчанию поле id
	$scope.orderProp = '-id';
	$scope.direction = false;	
    $scope.sort = function(column) {
      if ($scope.orderProp === column) {
        $scope.direction = !$scope.direction;
      } else {
        $scope.orderProp = column;
        $scope.direction = false;
      }
    }

	$scope.languages = [
		{'id': 0, 'title': 'Русский'},
		{'id': 1, 'title': 'Украинский'}
	]

	$scope.updateTime = function(){
		$timeout(function(){
			$scope.currentUnixDateTime = moment().unix();
			$scope.clock = (dateFilter(new Date(), 'HH:mm:ss'));
			$scope.theclock = (dateFilter(new Date(), 'HH:mm:ss'));
			$scope.updateTime();
		},1000);
	};

	$scope.updateTime();
});