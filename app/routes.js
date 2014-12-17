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
    $routeProvider.when('/logout', {
        templateUrl: 'app/components/login/logout.html',
        controller: 'logoutController'
    });
    $routeProvider.otherwise({
        redirectTo : '/login'
    });
});