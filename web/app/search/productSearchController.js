'use strict';

angular
    .module('starredUp')
    .controller('productSearchController', productSearchController);

function productSearchController(searchService, $scope, usSpinnerService) {
    var vm = this;
    vm.search = function (searchString)  {
        searchService.getProductSearchResults(searchString)
            .then(function (response) {
                vm.results = response.data;
            })
            .catch(function (error) {
                console.log("There was an error searching"+error);
            })
            .then(function () {
            });
    };

    vm.startSpin = function(){
        usSpinnerService.spin('spinner-search');
    };

    vm.stopSpin = function(){
        usSpinnerService.stop('spinner-search');
    };

    var init = function() {
        vm.search($scope.searchInput);
    };

    init();
}
productSearchController.$inject = ['searchService', '$scope', 'usSpinnerService'];
