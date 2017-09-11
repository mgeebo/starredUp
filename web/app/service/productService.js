'use strict';

angular
    .module('starredUp')
    .factory('productService', productService);

function productService($http) {

    return {
        getProduct: getProduct
    };

    function getProduct(productId) {
        return $http.get('/products/'+productId)
    }
}