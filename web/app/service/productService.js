'use strict';

angular
    .module('starredUp')
    .factory('productService', productService);


function productService($http) {

    return {
        getProduct: getProduct,
        getAllProducts: getAllProducts,
        getReviewsByProductId: getReviewsByProductId
    };

    function getProduct(productId) {
        return $http.get('/products/'+productId)
    }

    function getAllProducts() {
        return $http.get('/products/util/allProducts')
            .then(function (response) {
                return response.data;
            });
    }

    function getReviewsByProductId(productId) {
        return $http.get('/products/'+productId+'/reviews')
    }
}