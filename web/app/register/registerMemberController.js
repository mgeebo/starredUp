'use strict';

angular
    .module('starredUp')
    .controller('registerMemberController', registerMemberController);

function registerMemberController(memberService, $scope, $state) {
    var vm = this;

    // mock data for testing
    vm.member = {
        memberName: vm.memberName,
        memberFirstName : vm.memberFirstName,
        memberLastName: vm.memberLastName,
        memberEmail: vm.memberEmail,
        memberPassword: vm.password,
        dob: vm.dob
    };

    vm.save = function(member) {
        if ($scope.registerMemberForm.$valid) {
            memberService.registerMember(member)
                .then(function(){
                    $state.go('home');
                })
                .catch(function(error){
                });
        }
    };
}

registerMemberController.$inject = ['memberService', '$scope', '$state'];