'use strict';

shopApp.controller('homeController', ['$scope', '$http', '$location',
    function($scope, $http, $location) {

    $scope.formData = {};
    $scope.products = {};

    // list products
    $http({
        method: "GET",
        url: "api/products/list_products.php"
    }).success(function (response) {

        $scope.products = response.products; //change here
    });

    // add product
    $scope.processForm = function () {

        $scope.products.push($scope.formData);


        $http({
            method: 'POST',
            url: 'api/products/add_product.php',
            data: $.param($scope.formData),  // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)

        }).success(function (data) {
            console.log(data);
        });
    };

    // delete product
    $scope.deleteProduct = function (array, index, id) {

        array.splice(-index, 1);

        $http
            .delete('api/products/delete_product.php?id=' + id)
            .success(function (data) {
                alert('deleted');
            });
    };

      $scope.editProduct = function (id) {
          $location.path('/products/edit/'+id);
      };
}]);
