'use strict';

angular
    .module('starredUp')
    .controller('addReviewController', addReviewController);

function addReviewController(reviewService, productList, $scope, $state) {
    var vm = this;
    vm.productList = productList;
    vm.minRating = 1;
    vm.maxRating = 5;

    // mock data for member
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

    vm.save = function(review) {
        // check to make sure the form is completely valid
        if ($scope.addReviewForm.$valid) {
            vm.review.productId = vm.selectedProduct.productId;
            reviewService.saveReview(review)
                .then(function(){
                    $state.go('product_view', {productId: review.productId} );
                })
                .catch(function(error){
                });
        }
    };
}

addReviewController.$inject = ['reviewService', 'productList', '$scope', '$state'];
addReviewController.resolve = {
    productList: ['productService', function (productService) {
        return productService.getAllProducts();
    }]
};