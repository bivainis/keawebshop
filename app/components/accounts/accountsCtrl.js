'use strict';

shopApp.controller('accountsController', ['$scope', '$http', '$location',
    function ($scope, $http, $location) {

        $scope.message = '';

        $http
            .get('api/accounts/delete_account.php')
            .success(function (response) {
                console.log(response);
                $scope.message = response.message;
            });
    }
]);