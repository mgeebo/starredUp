'use strict';

angular
    .module("starredUp")
    .factory("accountService", accountService);

function accountService($http) {

    return {
        getMemberProfile: getMemberProfile
    };

    function getMemberProfile(memberId) {
        return $http.get('/members/'+memberId+'/getProfile')
            .then(function (response) {
                return response.data;
            });
    }

}