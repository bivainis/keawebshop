'use strict';

shopApp.controller('loginController', ['$scope', '$rootScope', '$http', '$location', function ($scope, $rootScope, $http, $location) {

    $scope.formData = {};

    $scope.processForm = function () {

        $http({
            method: 'POST',
            url: 'api/auth/login.php',
            data: $.param($scope.formData),  // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)

        }).success(function (data) {

            if (!data.success) {
                if(data.errors) {

                    $scope.errorEmail = data.errors.email;
                    $scope.errorPassword = data.errors.password;
                } else {
                    $scope.errorEmail = '';
                    $scope.errorPassword = '';
                }
            }

            $scope.message = data.message;
        });
    };

    $rootScope.$on('$routeChangeStart', function (event, next) {

        var userLoggedIn = false; /* Check if the user is logged in */

        if (!userLoggedIn && !next.isLogin) {
            /* You can save the user's location to take him back to the same page after he has logged-in */
            $rootScope.savedLocation = $location.url();

            $location.path('/login');
        }
    });
}]);