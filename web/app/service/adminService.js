'use strict';

angular
    .module("starredUp")
    .factory("adminService", adminService);

function adminService($http) {

    return {
        importProductsAndReviews: importProductsAndReviews
    };

    function importProductsAndReviews(upcs) {
        var config = {
            method: 'POST',
            url: '/admin/addProduct',
            data: $.param({productId: upcs}),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        };

        return $http(config);
    }

}

