'use strict';

shopApp.controller('homeController', ['$scope', '$http',
    function($scope, $http) {

    $scope.formData = {};
    $scope.products = {};

    $scope.processForm = function () {

        $http({
            method: 'POST',
            url: 'api/products/add_product.php',
            data: $.param($scope.formData),  // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)

        }).success(function (data) {
            console.log(data);
        });
    };

    $http({
        method: "GET",
        url: "api/products/list_products.php"
    }).success(function (response) {

        $scope.products = response.products; //change here
    })
}]);
