'use strict';

ShopFunnelsApp.controller('FunnelFormSettingsModalController', ['$scope', '$controller', 'data', '$uibModalInstance', 'ModalService',
    function($scope, $controller, data, $uibModalInstance, ModalService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            funnelForm: data.funnelForm,
            static: data.static
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
            });
        };

        $scope.deleteFunnelForm = function () {

        };

        $scope.submit = function (form) {
            $scope.state.submitted = true;

            $("form").valid();

            if (!form.$invalid) {
                $uibModalInstance.close();
            }
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
