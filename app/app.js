'use strict';

var shopApp = angular.module('shopApp', ['ngRoute']);

shopApp.controller('loginController', function($scope) {
    $scope.message = 'Look! I am an about page.';
});