'use strict';

ShopFunnelsApp.controller('ManageProductsModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'NgTableParams', 'ModalService',
    function($scope, $controller, data, $uibModalInstance, NgTableParams, ModalService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            formId: data.formId,
            products: data.products,
            static: data.static
        };

        $scope.productTable = new NgTableParams({
            count: 50
        }, {
            counts: [],
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.products, filters, params);
            }
        });

        $scope.createProduct = function () {
            var modal = ModalService.openGenericModal({
                size: 'md',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/newProductModalTemplate.html',
                controller: 'NewProductModalController',
                data: {
                    formId: $scope.data.formId,
                    static: $scope.data.static
                }
            });

            modal.result.then(function (response) {
            });
        };

        $scope.openProductSettings = function (product) {
            var modal = ModalService.openGenericModal({
                size: 'lg',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/productSettingsModalTemplate.html',
                controller: 'ProductSettingsModalController',
                data: {
                    product: product,
                    static: $scope.data.static
                }
            });

            modal.result.then(function (response) {
            });
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
