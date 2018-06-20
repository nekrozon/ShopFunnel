ShopFunnelsApp.directive('productList', function() {
    return {
        scope: {
            'shop': '='
        },
        restrict: 'E',
        replace: 'true',
        templateUrl: rootUrl + 'src/Front/Angular/views/directives/productListTemplate.html',
        controller: ['$scope', '$controller', 'NgTableParams', function($scope, $controller, NgTableParams) {

            angular.extend(this, $controller('BaseController', {$scope: $scope}));

            $scope.state = {
                loading: false,
                productSelected: false,
                step: 1
            };

            $scope.data.products = [];

            $scope.data.productTable = new NgTableParams({
                count: 25
            }, {
                sorting: {
                   title: 'asc'
                },
                getData: function (params) {
                    var filters = angular.copy(params.filter());
                    return $scope.filterRows($scope.data.products, filters, params);
                }
            });

            $scope.data.selectedProductTable = new NgTableParams({
                count: 25
            }, {
                sorting: {
                   title: 'asc'
                },
                getData: function (params) {
                    var filters = angular.copy(params.filter());
                    return $scope.filterRows($scope.data.products, filters, params);
                }
            });

            $scope.loadData = function () {
                for (var i = 0; i < 50; i++) {
                    $scope.data.products.push({
                        title: 'Product 1',
                        imgUrl: 'https://xxx.yyy.com/images/1.png'
                    });
                }
                $scope.data.productTable.reload();
            };

            $scope.selectionChanged = function () {
                $scope.state.productSelected = $scope.data.products.some(function (product) {
                    return product.selected;
                });
            };

            $scope.back = function () {
                $scope.state.step--;
            };

            $scope.next = function () {
                $scope.state.step++;
            };

            $scope.loadData();

        }]
    };
});
