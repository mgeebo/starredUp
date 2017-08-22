(function() {
    'use strict';

    angular
        .module("starredUp", ['ui.router'])
        .config(routes);

    function routes($stateProvider, $urlRouterProvider, $locationProvider) {
        $urlRouterProvider.otherwise('/home');
        $locationProvider.hashPrefix('');
        $stateProvider
            .state("home", {
                url: "/home",
                templateUrl: "app/home/home.html",
                controller: "homeController as $ctrl"
            })
            .state("product", {
                url: "/product",
                templateUrl: "app/product/product.html",
                controller: "productController as $ctrl"
            })
            .state("review", {
                url: "/review",
                templateUrl: "app/review/review.html",
                controller: "reviewController as $ctrl"
            })

    }
})();