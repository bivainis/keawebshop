'use strict';

shopApp.controller('partnersController', ['$scope', '$http',
    function($scope, $http) {

        $scope.partners = {};

        $http
            .get('api/partners/list_partners.php')
            .success(function (response) {
                console.log(response);
                $scope.partners = response;
            });
}]);
