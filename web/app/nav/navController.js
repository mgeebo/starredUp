'use strict';

angular
    .module("starredUp")
    .controller("navController", navController);

function navController($window, $http) {
    var vm = this;

    vm.authorizedMember = JSON.parse($window.sessionStorage.getItem("authorizedMember"));
    if (vm.authorizedMember !== null) {
        vm.member = {
            memberId: vm.authorizedMember.memberId,
            memberName: vm.authorizedMember.memberName,
            apiKey: vm.authorizedMember.apiKey
        };
        vm.welcomeMessage = "Welcome " + vm.member.memberName + "!";
    }

    vm.logout = function() {
        var config = {
            method: 'DELETE',
            url: '/api-key.json',
            headers: {
                'X-API-KEY': vm.member.apiKey
            }
        };
        return $http(config)
            .then(function (response) {
                $window.sessionStorage.clear();
                $window.location.reload();
            }).catch(function (reason) {
                console.log('failed', reason);
            }).then(function() {

            });
    }
}

navController.$inject = ['$window', '$http'];