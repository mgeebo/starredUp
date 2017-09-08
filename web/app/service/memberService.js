'use strict';

angular
    .module("starredUp")
    .factory("memberService", memberService);

function memberService() {

    return {: getMemberAndSource
    };

    function getMemberAndSource() {
        if (true) {

        }

        return $http.get('/reviews/component/recentReviews')
            .then(function (response) {
                return response.data;
            });
    }
}