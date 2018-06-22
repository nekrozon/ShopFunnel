'use strict';

ShopFunnelsApp.controller('HomeController', ['$scope', '$controller', 'HomeService',
    function ($scope, $controller, HomeService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.state.verified = false;

        $scope.submit = function () {
            if ($scope.data.shopname) {
                HomeService.verifyStore($scope.data.shopname).then(function (response) {
                    $scope.state.verified = true;
                    if (response.authorized) {
                        $scope.data.authInfo = 'Store already authorized';
                        setTimeout(function () {
                            window.location.href = rootUrl + 'dashboard';
                        }, 2000);
                    } else {
                        $scope.data.authInfo = 'Redirecting to shopify login...';
                        setTimeout(function () {
                            window.location.href = response.authUri;
                        }, 2000);
                    }
                });
            }
        };
    }
]);
