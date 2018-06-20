'use strict';

ShopFunnelsApp.controller('HomeController', ['$scope', 'HomeService',
    function ($scope, HomeService) {

        $scope.state = {
            verified : false,
            authSuccess : false
        };

        $scope.verify = function () {
            HomeService.verifyStore($scope.data.storeName).then(function (response) {
                $scope.state.verified = true;
                $scope.state.authSuccess = response.success;
            });
        };

        $scope.next = function () {
            window.location.href = rootUrl + 'products?shop=' + $scope.data.storeName + '.myshopify.com';
        };

        $scope.authorize = function () {
            HomeService.authorize($scope.data.storeName).then(function (response) {
                $scope.state.verified = false;
                $scope.state.authSuccess = false;
                window.open(response.authUri, '_blank');
            });
        };

        $scope.back = function () {
            $scope.state.verified = false;
            $scope.state.authSuccess = false;
        };
    }
]);
