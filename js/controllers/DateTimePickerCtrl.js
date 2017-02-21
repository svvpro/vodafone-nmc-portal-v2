app.controller('DateTimePickerCtrl', function($scope, $timeout){

    $scope.dateTimeNow = function() {
        $scope.date = new Date();
    };
    $scope.dateTimeNow();

    $scope.toggleMinDate = function() {
        $scope.minDate = $scope.minDate ? null : new Date();
    };

    $scope.maxDate = new Date('2014-06-22');
    $scope.toggleMinDate();

    $scope.dateOptions = {
        startingDay: 1,
        showWeeks: false
    };

    // Disable weekend selection
    $scope.disabled = function(calendarDate, mode) {
        return mode === 'day' && ( calendarDate.getDay() === 0 || calendarDate.getDay() === 6 );
    };

    $scope.hourStep = 1;
    $scope.minuteStep = 1;

    $scope.timeOptions = {
        hourStep: [1, 2, 3],
        minuteStep: [1, 5, 10, 15, 25, 30]
    };

    $scope.showMeridian = true;
    $scope.timeToggleMode = function() {
        $scope.showMeridian = !$scope.showMeridian;
    };

    $scope.$watch("date", function(value) {
        console.log('New date value:' + value);
    }, true);

    $scope.resetHours = function() {
        $scope.date.setHours(1);
    };

});
