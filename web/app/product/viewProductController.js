'use strict';

angular
    .module("starredUp")
    .controller("viewProductController", viewProductController);

function viewProductController(product) {
    var vm = this;
    vm.product = {};
    console.log(product.data.productDescription);
    vm.product = product.data;
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

viewProductController.$inject = ['product', 'productService'];
viewProductController.resolve = {
    product: ['productService', '$stateParams', function (productService, $stateParams) {
        return productService.getProduct($stateParams.productId)
    }]
};