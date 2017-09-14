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

    //carousel @todo
    // $scope.myInterval = 3000;
    // $scope.noWrapSlides = false;
    // $scope.active = 0;
    // $scope.slides = [
    //     {
    //         image: 'http://lorempixel.com/400/200/'
    //     },
    //     {
    //         image: 'http://lorempixel.com/400/200/food'
    //     },
    //     {
    //         image: 'http://lorempixel.com/400/200/sports'
    //     }
    // ];


}


homeController.$inject = ['recentReviews', 'featuredReviews', '$scope'];
homeController.resolve = {
    recentReviews: ['reviewService', function (reviewService) {
        return reviewService.getRecentReviews();
    }],
    featuredReviews: ['reviewService', function (reviewService) {
        return reviewService.getFeaturedReviews();
    }]
};