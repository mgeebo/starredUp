(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("productController", productController);

    function productController($http) {
        var vm = this;
        vm.data = "test";

        $http.get('api/products/95')
            .then(function (response) {
                vm.data = response;
            }, function (response) {
                console.log("nay");
            });
    }

})();