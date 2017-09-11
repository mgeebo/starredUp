'use strict';

angular
    .module("starredUp")
    .controller("homeController", homeController);

function homeController(recentReviews,featuredReviews, $scope) {
    var vm = this;
    vm.recentReviews = recentReviews;
    vm.featuredReviews = featuredReviews;

    vm.rate = 7;
    vm.max = 10;
    vm.isReadonly = false;

    vm.hoveringOver = function(value) {
        vm.overStar = value;
        vm.percent = 100 * (value / vm.max);
    };
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