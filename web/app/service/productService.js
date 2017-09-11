'use strict';

angular
    .module("starredUp")
    .factory("productService", productService);

function productService($http) {

    return {
        getAllProducts: getAllProducts
    };

    function getAllProducts() {
        return $http.get('/products/util/allProducts')
            .then(function (response) {
                return response.data;
            });
    }
}