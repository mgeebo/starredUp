'use strict';

angular
    .module("starredUp")
    .factory("memberService", memberService);

function memberService() {

    return {
        getMemberAndSource :getMemberAndSource
    };

    function getMemberAndSource() {
        return $http.get('/members/util/memberAndSource')
            .then(function (response) {
                return response.data;
            });
    }
}