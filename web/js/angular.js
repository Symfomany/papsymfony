'use strict';
const BASEURI = window.location.href.substring(0, window.location.href.indexOf('back')+4);

var addApp = angular.module('addApp', []).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

addApp.controller('NotificationsCtrl',['$scope','$http',
    function ($scope, $http) {

        var socket = io('http://127.0.0.1:8081');

        socket.on('notification', function (data) {
            $http({
                method: 'GET',
                url: 'http://localhost:8000/back/announcement/ajax',
            }).success(function(data){
                $scope.notifications = data;
            }).error(function(){
            });
        });

        socket.on('announcement', function (data) {
            $http({
                method: 'GET',
                url: 'http://localhost:8000/back/announcement/ajax',
            }).success(function(data){
                $scope.notifications = data;
            }).error(function(){
            });
        });

        $scope.clear= function(){

            $scope.notifications = [];
        };

        $scope.approuve= function(notification){

            $http({
                method: 'GET',
                url: 'http://localhost:8000/back/announcement/ajax',
            }).success(function(data){
                $scope.notifications = data;
            }).error(function(){
            });


        };



        $scope.remove= function(notification){

            $scope.notifications.splice($scope.notifications.indexOf(notification), 1);
            console.log(notification);
            $http({
                method: 'GET',
                url: 'http://localhost:8000/back/announcement/removeajax/'+notification.id
            }).success(function(data){
                $scope.notifications = data;
            }).error(function(){
            });

        };

        $http({
            method: 'GET',
            url: 'http://localhost:8000/back/announcement/ajax',
        }).success(function(data){
            $scope.notifications = data;
        }).error(function(){
        });

    }]);