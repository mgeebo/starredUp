(function() {
    'use strict';

    angular
        .module("starredUp")
        .controller("testController", testController);

    function testController($http) {
        var vm = this;
        var data = {
            productId: 12345
        };

        $http.post('/test/add', data)
            .then(function (response) {
                console.log("yay");
            }, function (response) {
                console.log("nay");
            });
    }

})();