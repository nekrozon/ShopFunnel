'use strict';

ShopFunnelsApp.controller('NewProductModalController', ['$scope', '$controller', 'data', '$uibModalInstance',
    function($scope, $controller, data, $uibModalInstance) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.data = {
            formId: data.formId,
            products: [],
            static: data.static
        };

        for (var i in $scope.data.static.productTypes) {
            if ($scope.data.static.productTypes[i].id == $scope.data.static.constants.productTypeEnum.STANDARD) {
                $scope.data.productType = $scope.data.static.productTypes[i];
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
