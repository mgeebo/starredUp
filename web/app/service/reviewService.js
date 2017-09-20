'use strict';

angular
    .module('starredUp')
    .factory('reviewService', reviewService);

function reviewService($http) {
    return {
        getRecentReviews: getRecentReviews,
        getFeaturedReviews: getFeaturedReviews,
        getReview: getReview,
        getProductByReviewId: getProductByReviewId,
        saveReview: saveReview
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

    function getReview(reviewId) {
        return $http.get('/reviews/'+reviewId)
            .then(function (response) {
                return response.data;
            });
    }

    function getProductByReviewId(reviewId) {
        return $http.get('/reviews/util/productByReviewId/'+reviewId)
            .then(function (response) {
                return response.data;
            });
    }

    function saveReview(review) {
        var config = {
            method: 'POST',
            url: '/reviews/'+review.reviewId,
            data: review,
            headers: {
                'Content-Type': 'application/json; charset=utf-8'
            }
        };
        return $http(config)
            .then(function (response) {
                return response.data;
            }, function (reason) {
                console.log('failed', reason);
            });
    }
}