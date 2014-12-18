'use strict';

shopApp.controller('logoutController', ['$scope', '$rootScope' , '$http', '$location',
    function ($scope, $rootScope, $http, $location) {
        $http
            .get('api/auth/logout.php')
            .success(function (response) {

                $location.path('/login');
            });
    }
]);