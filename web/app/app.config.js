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
            controller: 'homeController as vm',
            resolve: homeController.resolve
        })
        .state('product', {
            url: '/product',
            templateUrl: 'app/product/product.html',
            controller: 'productController as vm'
        })
            .state('product_edit', {
                url: '/product/:productId',
                templateUrl: 'app/product/product.html',
                controller: 'productController as vm'
            })
        .state('review', {
            url: '/review',
            templateUrl: 'app/review/review.html',
            controller: 'reviewController as vm',
            resolve: reviewController.resolve
        })
            .state('review_edit', {
                url: '/review/:reviewId',
                templateUrl: 'app/review/editReview.html',
                controller: 'editReviewController as vm',
                resolve: editReviewController.resolve
            })
            .state('review_add', {
                url: '/review/new',
                templateUrl: 'app/review/addReview.html',
                controller: 'addReviewController as vm',
                resolve: addReviewController.resolve
            })
}