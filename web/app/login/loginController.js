'use strict';

angular
    .module("starredUp")
    .controller("loginController", loginController);

function loginController(loginService, $window, $state) {
    var vm = this;
    vm.memberName = '';
    vm.password = '';
    vm.buttonText = "Next";

    vm.next = function () {
        if (vm.buttonText === 'Next') {
            vm.buttonText = "Login";
        } else {
            loginService.authorizeUser(vm.memberName, vm.password)
                .then(function (success) {
                    console.log(success.data);
                    vm.errorMessage = '';
                    $window.sessionStorage.setItem("authorizedMember", JSON.stringify(success.data));
                    $window.location.reload();
                    $window.location.href = '/#/home';

                })
                .catch(function (error) {
                    console.log(error);
                    vm.errorMessage = "Invalid Credentials";
                })
                .then(function () {
                })
        }
    };

    vm.back = function () {

    }
}

loginController.$inject = ['loginService', '$window', '$state'];