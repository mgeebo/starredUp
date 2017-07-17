(function() {
    'use strict';

    angular
        .module("starredUp", ['ngRoute'])
        .config(routes);

    function routes($routeProvider) {
        $routeProvider
            .when("/whodat", {
                templateUrl: "app/login/login.html",
                controller: "loginController"
            })
            .when("/test", {
                templateUrl: "../lucky.html",
                controller: "controllers/testController"
            })
            .otherwise({
                redirectTo: "/"
            });
    }
})();