(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("homeController", homeController);

    function homeController($http) {
        var vm = this;
        vm.data = "test";

        $http.get('/products/41')
            .then(function (response) {
                vm.data = response;
            }, function (response) {
                console.log("nay");
            });
    }

})();