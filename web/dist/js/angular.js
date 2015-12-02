var addApp = angular.module('addApp', []);

addApp.controller('NotificationsCtrl', ['$scope', function ($scope) {
    $scope.orderProp = 'age';
}]);