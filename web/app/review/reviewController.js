'use strict';

angular
    .module("starredUp")
    .controller("reviewController", reviewController);

function reviewController(recentReviews, featuredReviews) {
    var vm = this;
    vm.recentReviews = recentReviews;
    vm.featuredReviews = featuredReviews;
}

reviewController.$inject = ['recentReviews', 'featuredReviews'];
reviewController.resolve = {
    recentReviews: ['reviewService', function (reviewService) {
        return reviewService.getRecentReviews();
    }],
    featuredReviews: ['reviewService', function (reviewService) {
        return reviewService.getFeaturedReviews();
    }]
};