'use strict';

angular
    .module('starredUp')
    .controller('addProductAdminController', addProductAdminController);

function addProductAdminController(adminService, $scope, usSpinnerService) {
    var vm = this;
    vm.upcs = [];
    vm.success = null;
    vm.message = 'There was an error';

    vm.addField = function() {
        vm.upcs.push( {} )
    };
    vm.removeField = function() {
        vm.upcs.pop()
    };

    vm.import = function(upcs) {
        if ($scope.importProductsAndReviewsForm.$valid) {
            vm.startSpin();
            var upcString = '';
            angular.forEach(upcs, function(upc, idx) {
                if (idx === upcs.length - 1) {
                    upcString += upc.value;
                } else {
                    upcString += upc.value + ',';
                }
            });
            adminService.importProductsAndReviews(upcString)
                .then(function(data) {
                    vm.success = true;
                    vm.message = 'Success! Products and reviews were added!';
                    vm.stopSpin();
                })
                .catch(function(error) {
                    vm.sucess = false;
                    vm.message = 'Error. There was an error saving.';
                    vm.stopSpin();
                });
        }
    };

    vm.startSpin = function() {
        usSpinnerService.spin('spinner-1');
    };

    vm.stopSpin = function() {
        usSpinnerService.stop('spinner-1');
    };

}

addProductAdminController.$inject = ['adminService', '$scope', 'usSpinnerService'];