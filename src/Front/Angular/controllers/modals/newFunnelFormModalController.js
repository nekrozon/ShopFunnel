'use strict';

ShopFunnelsApp.controller('NewFunnelFormModalController', ['$scope', '$controller', 'data', '$uibModalInstance',
    function($scope, $controller, data, $uibModalInstance) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            formTypes: data.formTypes
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
