'use strict';

angular
    .module("starredUp")
    .factory("searchService", searchService);

function searchService($http) {

    return {
        getProductSearchResults: getProductSearchResults
    };

    function getProductSearchResults(searchString) {
        return $http.get('/products/search/results/'+searchString)
    }
}