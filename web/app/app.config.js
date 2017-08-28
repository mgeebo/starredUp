'use strict';

angular
    .module('starredUp', ['ui.router'])
    .config(routes);

function routes($stateProvider, $urlRouterProvider, $locationProvider) {
    $urlRouterProvider.otherwise('/home');
    $locationProvider.hashPrefix('');
    $stateProvider
        .state('home', {
            url: '/home',
            templateUrl: 'app/home/home.html',
            controller: 'homeController as vm'
        })
        .state('product', {
            url: '/product',
            templateUrl: 'app/product/product.html',
            controller: 'productController as vm'
        })
        .state('review', {
            url: '/review',
            templateUrl: 'app/review/review.html',
            controller: 'reviewController',
            controllerAs: 'vm',
            resolve: reviewController.resolve
        })
}