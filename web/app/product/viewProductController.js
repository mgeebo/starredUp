'use strict';

angular
    .module("starredUp")
    .controller("viewProductController", viewProductController);

function viewProductController(product, productService) {
    var vm = this;
    vm.product = product.data;
}

viewProductController.$inject = ['product', 'productService'];
viewProductController.resolve = {
    product: ['productService', '$stateParams', function (productService, $stateParams) {
        return productService.getProduct($stateParams.productId)
    }]
};