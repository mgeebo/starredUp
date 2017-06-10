(function() {
    'use strict';

    angular
        .module("starredUp", ['ngRoute'])
        .config(routes);

    function routes($routeProvider) {
        $routeProvider
            .when("/", {
                templateUrl: "app/login/login.html",
                controller: "loginController"
            })
            .when("/lucky/lumber", {
                templateUrl: "views/lucky/lucky.html",
                controller: "controllers/luckyController"
            })
            .otherwise({
                redirectTo: "/"
            });
    }
})();