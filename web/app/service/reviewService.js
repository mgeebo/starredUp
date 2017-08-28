'use strict';

angular
    .module("starredUp")
    .factory("reviewService", reviewService);

function reviewService($http) {
    return {
        getRecentReviews: getRecentReviews,
        getFeaturedReviews: getFeaturedReviews
    };

    function getRecentReviews() {
        return $http.get('/reviews/component/recentReviews')
            .then(function (response) {
                return response.data;
            });
    }

    function getFeaturedReviews() {
        return $http.get('/reviews/component/featuredReviews')
            .then(function (response) {
                return response.data;
            });
    }
}