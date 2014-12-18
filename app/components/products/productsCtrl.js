'use strict';

shopApp.controller('productsController', ['$scope', '$http','$routeParams',
    function($scope, $http, $routeParams) {

        var productId = $routeParams.productId;
        $scope.formData = {};

        // add product
        $scope.processForm = function () {

            $scope.formData.product_id = productId;

            $http({
                method: 'POST',
                url: 'api/products/save_product.php',
                data: $.param($scope.formData),  // pass in data as strings
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)

            }).success(function (data) {

            });
        };
        $http
            .get('api/products/get_edit_product.php?id=' + productId)
            .success(function (response) {
                console.log(response[0]);
                $scope.formData = response[0];
            });
}]);
