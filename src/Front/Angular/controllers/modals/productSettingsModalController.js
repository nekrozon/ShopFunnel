'use strict';

ShopFunnelsApp.controller('ProductSettingsModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'DashboardService', 'ModalService',
    function($scope, $controller, data, $uibModalInstance, DashboardService, ModalService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            product: data.product,
            static: data.static
        };

        $scope.submit = function (form) {
            $scope.state.submitted = true;

            $("form").valid();

            if (!form.$invalid) {
                DashboardService.updateProduct($scope.data.product).then(function (response) {
                    toastr.success('Product Update Success');
                    $uibModalInstance.close();
                });
            }
        };

        $scope.delete = function () {
            var modal = ModalService.openConfirmModal('Confirm Delete', 'Do you want to delete this product?', 'Confirm', 'Cancel', 'sm');

            modal.result.then(function (response) {
                if (response) {
                    DashboardService.deleteProduct($scope.data.product.id).then(function (response) {
                        toastr.success('Product Delete Success');
                        $uibModalInstance.close(true);
                    });
                }
            });
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
