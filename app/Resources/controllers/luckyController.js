(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("luckyController", luckyController);

    function luckyController($http) {
        var vm = this;
        vm.message = "You are logged in.";
        alert("here");
        $http.get('app/src/AppBundle/Controller/LuckyController.php')
            .then(function successCallback() {
                console.log("yay");
            }, function errorCallback() {
                console.log("nay");
            });
    }

})();