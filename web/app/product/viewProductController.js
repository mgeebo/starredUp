'use strict';

angular
    .module("starredUp")
    .controller("viewProductController", viewProductController);

function viewProductController(product, productReviews) {
    var vm = this;
    vm.product = {};
    vm.product = product.data;
    vm.reviews = productReviews.data;
    vm.product.productDescription = vm.product.productDescription.replace(/&\w+?;/g, function( e ) {
        switch (e) {
            case '&lt;':
                return '';
            case '':
                return '';
            default:
                return e;
        }
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