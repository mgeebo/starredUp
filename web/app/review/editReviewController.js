'use strict';

angular
    .module("starredUp")
    .controller("editReviewController", editReviewController);

function editReviewController(review, reviewService, $window) {
    var vm = this;
    vm.edit = false;
    vm.review = review;

    vm.authorizedMember = JSON.parse($window.sessionStorage.getItem("authorizedMember"));
    if (vm.authorizedMember !== null) {
        vm.member = {
            memberId: vm.authorizedMember.memberId,
            memberName: vm.authorizedMember.memberName,
            apiKey: vm.authorizedMember.apiKey
        };
    }

    vm.save = function (review) {
        reviewService.saveReview(review);
    };
    vm.back = function () {
        $state.go('product_view', {productId: review.productId} );
    }
}

editReviewController.$inject = ['review', 'reviewService', '$window', '$state'];
editReviewController.resolve = {
    review: ['reviewService', '$stateParams', function (reviewService, $stateParams) {
        return reviewService.getReview($stateParams.reviewId);
    }],
    product: ['reviewService', '$stateParams', function (reviewService, $stateParams) {
        return reviewService.getProductByReviewId($stateParams.reviewId);
    }]
};