(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("reviewController", reviewController);

    function reviewController($http) {
        var vm = this;
        vm.data = "test";


    }

})();