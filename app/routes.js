'use strict';

shopApp.config(function ($routeProvider) {

    $routeProvider.when('/', {
        templateUrl: 'app/components/login/login.html',
        controller: 'loginController',
        isLogin: true
    });
    $routeProvider.when('/home', {
        templateUrl: 'app/components/home/home.html',
        controller: 'homeController'
    });
    $routeProvider.when('/login', {
        templateUrl: 'app/components/login/login.html',
        controller: 'loginController',
        isLogin: true
    });
    $routeProvider.when('/register', {
        templateUrl: 'app/components/register/register.html',
        controller: 'registerController'
    });
    $routeProvider.otherwise({
        redirectTo : '/login'
    });
});