'use strict';

shopApp.controller('logoutController', ['$scope', '$http', '$location',
    function ($scope, $http, $location) {
        $http
            .get('api/auth/logout.php')
            .success(function (response) {

                $location.path('/login');
            });
    }
]);