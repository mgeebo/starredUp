'use strict';

angular
    .module('starredUp', ['ui.router'])
    .config(routes);

function routes($stateProvider, $urlRouterProvider, $locationProvider) {
    $urlRouterProvider.otherwise('/home');
    $locationProvider.hashPrefix('');
    $stateProvider
        .state('admin_addProduct', {
            url: '/admin/addProduct',
            templateUrl: 'app/admin/addProductAdmin.html',
            controller: 'addProductAdminController as vm'
        })
        .state('home', {
            url: '/home',
            templateUrl: 'app/home/home.html',
            controller: 'homeController as vm',
            resolve: homeController.resolve
        })
        .state('create_account', {
            url: '/register',
            templateUrl: 'app/register/registerMember.html',
            controller: 'registerMemberController as vm'
        })
        .state('product', {
            url: '/product',
            templateUrl: 'app/product/product.html',
            controller: 'productController as vm'
        })
            .state('product_view', {
                url: '/product/:productId',
                templateUrl: 'app/product/viewProduct.html',
                controller: 'viewProductController as vm',
                resolve: viewProductController.resolve
            })
        .state('review', {
            url: '/review',
            templateUrl: 'app/review/review.html',
            controller: 'reviewController as vm',
            resolve: reviewController.resolve
        })
            .state('review_add', {
                url: '/review/new',
                templateUrl: 'app/review/addReview.html',
                controller: 'addReviewController as vm',
                resolve: addReviewController.resolve
            })
            .state('review_edit', {
                url: '/review/:reviewId',
                templateUrl: 'app/review/editReview.html',
                controller: 'editReviewController as vm',
                resolve: editReviewController.resolve
            })
        .state('login', {
            url: '/login',
            templateUrl: 'app/login/login.html',
            controller: 'loginController as vm',
            resolve: loginController.resolve
        })
        .state('search', {
            url: '/search/results',
            templateUrl: 'app/search/productSearch.html',
            controller: 'productSearchController as vm',
            resolve: productSearchController.resolve
        })
}