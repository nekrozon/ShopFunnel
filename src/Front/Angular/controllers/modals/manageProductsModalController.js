'use strict';

ShopFunnelsApp.controller('ManageProductsModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'NgTableParams', 'ModalService', 'DashboardService',
    function($scope, $controller, data, $uibModalInstance, NgTableParams, ModalService, DashboardService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            formId: data.formId,
            products: data.products,
            static: data.static,
            productsChanged: false
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
                $scope.data.productsChanged = true;
                $scope.refreshProductTable();
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
                if (response) {
                    $scope.data.productsChanged = true;
                    $scope.refreshProductTable();
                }
            });
        };

        $scope.refreshProductTable = function () {
            DashboardService.getFormProducts($scope.data.formId).then(function (response) {
                if (response.success) {
                    $scope.data.products = response.products;
                    $scope.productTable.reload();
                } else {
                    toastr.error(response.errorMsg);
                }
            });
        };

        $scope.close = function() {
            $uibModalInstance.close($scope.data.productsChanged);
        };

        $scope.$on('modal.closing', function (event, reason, closed) {
            if (!closed && $scope.state.editing && (reason == 'backdrop click' || reason == 'escape key press')) {
                event.preventDefault();

                $uibModalInstance.close($scope.data.productsChanged);
            }
        });
    }
]);
