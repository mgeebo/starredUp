(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("homeController", homeController);

    function homeController($http) {
        var vm = this;
        vm.data = "test";

    }

})();