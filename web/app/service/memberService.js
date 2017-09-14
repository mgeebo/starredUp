'use strict';

angular
    .module("starredUp")
    .factory("memberService", memberService);

function memberService($http) {

    return {
        getMemberAndSource :getMemberAndSource,
        registerMember: registerMember
    };

    function getMemberAndSource() {
        return $http.get('/members/util/memberAndSource')
            .then(function (response) {
                return response.data;
            });
    }

    function registerMember(member){
        console.log('service', member);
        var config = {
            method: 'POST',
            url: '/members/add',
            data: member,
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