'use strict';

ShopFunnelsApp.controller('FunnelFormSettingsModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'ModalService', 'DashboardService',
    function($scope, $controller, data, $uibModalInstance, ModalService, DashboardService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            funnelForm: data.funnelForm,
            static: data.static,
            productsChanged: false
        };

        $scope.manageProducts = function () {
            var modal = ModalService.openGenericModal({
                size: 'lg',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/manageProductsModalTemplate.html',
                controller: 'ManageProductsModalController',
                data: {
                    formId: $scope.data.funnelForm.id,
                    products: $scope.data.funnelForm.products,
                    static: $scope.data.static
                }
            });

            modal.result.then(function (response) {
                $scope.data.productsChanged = productsChanged;
                console.log($scope.data.productsChanged);
            });
        };

        $scope.deleteFunnelForm = function () {
            var modal = ModalService.openConfirmModal('Confirm Delete', 'Do you want to delete this form?', 'Confirm', 'Cancel', 'sm');

            modal.result.then(function (response) {
                if (response) {
                    DashboardService.deleteForm($scope.data.funnelForm.id).then(function (response) {
                        toastr.success('Funnel Form Delete Success');
                        $uibModalInstance.close(true);
                    });
                }
            });
        };

        $scope.submit = function (form) {
            $scope.state.submitted = true;

            $("form").valid();

            if (!form.$invalid) {
                DashboardService.updateForm($scope.data.funnelForm).then(function (response) {
                    toastr.success('Funnel Form Update Success');
                    $uibModalInstance.close(true);
                });
            }
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
