'use strict';

angular
    .module("starredUp")
    .controller("viewProductController", viewProductController);

function viewProductController(product, productReviews) {
    var vm = this;
    vm.product = {};
    vm.product = product.data;
    vm.reviews = productReviews.data;
    vm.product.productDescription = vm.product.productDescription.replace(/&(.*?)([A-Z]|" ")/g, function( e ) {
        return ' ' + e.substr(e.length-1);
    })
 }

viewProductController.$inject = ['product', 'productReviews'];

viewProductController.resolve = {
    product: ['productService', '$stateParams', function (productService, $stateParams) {
        return productService.getProduct($stateParams.productId)
    }],
    productReviews: ['productService', '$stateParams', function (productService, $stateParams) {
        return productService.getReviewsByProductId($stateParams.productId)
    }]
};