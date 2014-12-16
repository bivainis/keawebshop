'use strict';

shopApp.controller('registerController', function ($scope, $http) {

    $scope.formData = {};

    $scope.processForm = function () {

        $http({
            method: 'POST',
            url: 'api/auth/register.php',
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
});
