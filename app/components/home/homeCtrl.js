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

    $scope.addOrder = function(id) {
        $location.path('/orders/add/'+id);
    };
}]);
