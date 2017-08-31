'use strict';

angular
    .module("starredUp")
    .controller("homeController", homeController);

function homeController(recentReviews,featuredReviews) {
        var vm = this;
        vm.recentReviews = recentReviews;
        vm.featuredReviews = featuredReviews;
}


homeController.$inject = ['recentReviews', 'featuredReviews'];
homeController.resolve = {
    recentReviews: ['reviewService', function (reviewService) {
        return reviewService.getRecentReviews();
    }],
    featuredReviews: ['reviewService', function (reviewService) {
        return reviewService.getFeaturedReviews();
    }]
};