'use strict';

ShopFunnelsApp.controller('NewFunnelFormModalController', ['$scope', '$controller', 'data', '$uibModalInstance',
    function($scope, $controller, data, $uibModalInstance) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            funnelForm: {},
            static: data.static
        };

        for (var i in $scope.data.static.funnelFormTypes) {
            if ($scope.data.static.funnelFormTypes[i].id == $scope.data.static.constants.funnelFormTypeEnum.CUSTOM_FORM) {
                $scope.data.funnelForm.type = $scope.data.static.funnelFormTypes[i];
                break;
            }
        }

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
