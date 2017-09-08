'use strict';

angular
    .module('starredUp')
    .controller('addReviewController', addReviewController);

function addReviewController(reviewService, productList, $state) {
    var vm = this;
    vm.productList = productList;
    vm.selectedProduct = '';
    vm.saveDisabled = false;


    vm.member = {
        memberId: 1,
        memberName: 'test-user'
    };

    vm.review = {
        productId: '',
        rating: '',
        memberId: vm.member.memberId,
        reviewTitle: '',
        description: ''
    };

    // pseudo code for login
    if (angular.isUndefined(vm.member)) {
        return false;
        // some error message
    }

    vm.save = function (review) {
        if (angular.isUndefined(review.productId = vm.selectedProduct.productId)) {
            return;
        }
        vm.saveDisabled = true;


        reviewService.saveReview(review)
            .then(function(){
                $state.transitionTo('product_edit', {productId: review.productId} );
            })
            .catch(function(error){
            });
    }
}

addReviewController.$inject = ['reviewService', 'productList'];

addReviewController.resolve = {
    productList: ['productService', function (productService) {
        return productService.getAllProducts();
    }]
};