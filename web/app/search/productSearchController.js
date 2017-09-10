'use strict';

angular
    .module('starredUp')
    .controller('productSearchController', productSearchController);

function productSearchController(searchService, $rootScope, $scope) {
    var vm = this;
    console.log($scope.searchInput);

    vm.search = function (searchString) {
        searchService.getProductSearchResults(searchString)
            .then(function (response) {
                vm.results = response.data;
            });
    };

    var init = function() {
        vm.search($scope.searchInput);
    };

    init();
}
productSearchController.$inject = ['searchService', '$rootScope', '$scope'];
