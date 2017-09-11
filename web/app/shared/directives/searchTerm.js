'use strict';

angular
    .module('starredUp')
    .directive('searchTerm', searchTerm);

function searchTerm($rootScope) {
    return {
        link: function(scope, element, attrs) {
            element.on('change', function (e) {
                $rootScope.searchInput = e.target.value;
            })
        }
    };
}