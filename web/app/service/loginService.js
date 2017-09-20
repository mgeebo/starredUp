'use strict';

angular
    .module("starredUp")
    .factory("loginService", loginService);

function loginService($http) {

    return {
        authorizeUser: authorizeUser
    };

    function authorizeUser(memberName, password) {
        var config = {
            method: 'POST',
            url: '/api-key.json',
            data: $.param({login: memberName, password: password}),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };

        return $http(config);
    }


}