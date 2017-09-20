(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("productController", productController);

    function productController($http) {
        var vm = this;
        vm.data = '';

        $http.get('/products/95')
            .then(function (response) {
                vm.data = response;
            }, function (response) {
                console.log("error");
            });
    }

})();