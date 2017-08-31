'use strict';

angular
    .module("starredUp")
    .controller("editReviewController", editReviewController);

function editReviewController(review, reviewService) {
    var vm = this;
    vm.edit = false;
    vm.review = review;

    //pseudo code
    // var user = "user";
    // if (user.isAdmin && user.notExternal) {
    //     vm.readOnly = false;
    // }

    vm.save = function (review) {
        reviewService.saveReview(review);
    }
}

editReviewController.$inject = ['review', 'reviewService'];
editReviewController.resolve = {
    review: ['reviewService', '$stateParams', function (reviewService, $stateParams) {
        return reviewService.getReview($stateParams.reviewId);
    }],
    product: ['reviewService', '$stateParams', function (reviewService, $stateParams) {
        return reviewService.getProductByReviewId($stateParams.reviewId);
    }]
};