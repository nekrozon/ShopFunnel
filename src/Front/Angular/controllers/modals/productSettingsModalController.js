'use strict';

ShopFunnelsApp.controller('ProductSettingsModalController', ['$scope', '$controller', 'data', '$uibModalInstance',
    function($scope, $controller, data, $uibModalInstance) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            product: data.product,
            static: data.static
        };

        $scope.submit = function (form) {
            $scope.state.submitted = true;

            $("form").valid();

            if (!form.$invalid) {
                $uibModalInstance.close();
            }
        };

        $scope.delete = function () {
            $uibModalInstance.close();
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
