'use strict';

ShopFunnelsApp.controller('OrderDetailModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'NgTableParams',
    function($scope, $controller, data, $uibModalInstance, NgTableParams) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            order: data.order
        };

        $scope.orderProductsTable = new NgTableParams({
            count: 50
        }, {
            counts: [],
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.order.products, filters, params);
            }
        });

        $scope.archiveOrder = function () {
            // DashboardService.archiveOrder($scope.data.order.id).then(function (response) {
            //     $uibModalInstance.close();
            // }, function (error) {
            //     console.log(error);
            // });
            $uibModalInstance.close();
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
