'use strict';

shopApp.controller('loginController', function ($scope, $http) {

    $scope.formData = {};

    $scope.processForm = function () {

        $http({
            method: 'POST',
            url: 'api/auth/login.php',
            data: $.param($scope.formData),  // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).success(function (data) {

            console.log(data);

                if (!data.success) {

                    $scope.errorEmail = data.errors.email;
                    $scope.errorPassword = data.errors.password;

                } else {
                    $scope.errorEmail = '';
                    $scope.errorPassword = '';
                    $scope.message = data.message;
                }
            });
    };
});
