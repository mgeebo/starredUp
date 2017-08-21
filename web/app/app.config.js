(function() {
    'use strict';

    angular
        .module("starredUp", ['ngRoute'])
        .config(routes);

    function routes($routeProvider) {
        $routeProvider
            .when("/some/url/here", {
                templateUrl: "app/login/login.html",
                controller: "loginController"
            })
            .otherwise({
                redirectTo: "/",
                templateUrl: "app/home/home.html",
                controller: "homeController as $ctrl"
            });
    }
})();