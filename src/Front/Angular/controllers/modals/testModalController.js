'use strict';

ShopFunnelsApp.controller('TestModalController', ['$scope', 'data', '$uibModalInstance', 'TestService',
    function($scope, data, $uibModalInstance, TestService) {

        $scope.data = {
            sample: data.sample
        };

        $scope.submit = function (form) {
            $scope.state.submitted = true;

            $("form").valid();

            if (!form.$invalid) {
                TestService.testAction($scope.data).then(function (response) {
                    $uibModalInstance.close(response);
                }, function (error) {
                    console.log(error);
                });
            }
        };

        $scope.close = function() {
            $uibModalInstance.dismiss();
        };
    }
]);
