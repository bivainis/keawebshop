'use strict';

shopApp.controller('loginController', ['$scope', '$rootScope', '$http', '$location',
    function ($scope, $rootScope, $http, $location) {

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
                } else {

                    $location.path('/home');
                }

                $scope.message = data.message;
            });
        };

        $rootScope.$on('$routeChangeStart', function (event, next) {

            var userLoggedIn = false;

            $http
                .get('api/auth/get_session.php?loggedin')
                .success(function (response) {
                    if(response.loggedin == true){
                        userLoggedIn = true;
                    } else {
                        if (!next.isLogin) {

                            $location.path('/login');
                        }
                    }
                });
        });
    }
]);