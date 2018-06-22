'use strict';

ShopFunnelsApp.controller('DashboardController', ['$scope', '$controller', 'DashboardService',
    function ($scope, $controller, DashboardService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));
        
    }
]);
