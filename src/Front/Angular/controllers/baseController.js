'use strict';

ShopFunnelsApp.controller('BaseController', ['$scope', 'orderByFilter', 'filterFilter',
    function($scope, orderBy, filter) {

        $scope.data = {};
        $scope.state = {};

        $scope.filterRows = function (rows, filters, params) {
            if (typeof rows == 'undefined') {
                return [];
            }

            if (typeof rows.length == 'undefined' && typeof rows == 'object') {
                var arrRows = [];
                angular.forEach(rows, function (row) {
                    arrRows.push(row);
                });
                rows = arrRows;
            }

            rows = filter(rows, filters);
            var sorting = params.sorting();
            var key = Object.keys(sorting)[0];
            if (key) {
                rows = orderBy(rows, key, sorting[key] == 'desc');
            }
            params.total(rows.length);

            return rows.slice((params.page() - 1) * params.count(), params.page() * params.count());
        };
    }
]);
