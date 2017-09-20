'use strict';

angular
    .module("starredUp")
    .controller("accountController", accountController);

function accountController(memberProfile) {
    var vm = this;
    vm.memberProfile = memberProfile;
    console.log(vm.memberProfile);
}

accountController.$inject = ['memberProfile'];
accountController.resolve = {
    memberProfile: ['accountService', '$window', function (accountService, $window) {
        var member = JSON.parse($window.sessionStorage.getItem("authorizedMember"));
        return accountService.getMemberProfile(member.memberId);
    }]
};