'use strict';

angular
    .module('starredUp')
    .controller('registerMemberController', registerMemberController);

function registerMemberController(memberService, $scope, $state) {
    var vm = this;

    // mock data
    vm.member = {
        memberName: vm.memberName,
        memberFirstName : vm.memberFirstName,
        memberLastName: vm.memberLastName,
        memberEmail: vm.memberEmail,
        memberPassword: vm.password,
        dob: vm.dob
    };

    vm.save = function(member) {
        console.log('member', member);
        if ($scope.registerMemberForm.$valid) {
            memberService.registerMember(member)
                .then(function(){

                })
                .catch(function(error){
                });
        }
        $state.go('home');
    };
}

registerMemberController.$inject = ['memberService', '$scope', '$state'];