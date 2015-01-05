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
        controller: 'registerController',
        isLogin: true
    });
    $routeProvider.when('/logout', {
        templateUrl: 'app/components/login/logout.html',
        controller: 'logoutController'
    });
    $routeProvider.when('/accounts/delete', {
        templateUrl: 'app/components/accounts/account_deleted.html',
        controller: 'accountsController'
    });
    $routeProvider.when('/products/add', {
      templateUrl: 'app/components/products/add_product.html',
      controller: 'productsController'
    });
    $routeProvider.when('/products/edit/:productId', {
        templateUrl: 'app/components/products/edit_product.html',
        controller: 'productsController'
    });
    $routeProvider.when('/partners/list', {
        templateUrl: 'app/components/partners/list_partners.html',
        controller: 'partnersController'
    });
    $routeProvider.when('/orders/add/:productId', {
      templateUrl: 'app/components/orders/add_order.html',
      controller: 'productsController'
    });
    $routeProvider.otherwise({
        redirectTo : '/login'
    });
});
