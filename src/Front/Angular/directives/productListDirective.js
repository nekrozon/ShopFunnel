ShopFunnelsApp.directive('productList', function() {
    return {
        scope: {
            'shop': '='
        },
        restrict: 'E',
        replace: 'true',
        templateUrl: rootUrl + 'src/Front/Angular/views/directives/productListTemplate.html',
        controller: ['$scope', '$controller', 'NgTableParams', 'ProductService', function($scope, $controller, NgTableParams, ProductService) {

            angular.extend(this, $controller('BaseController', {$scope: $scope}));

            $scope.state = {
                loading: false,
                loadSuccess: false,
                productSelected: false,
                step: 1
            };

            $scope.data = {
                products: [],
                selectedProducts: [],
                errorMsg: '',
                titleFilter: {
                    title: {
                        id: 'text',
                        placeholder: 'Filter by title...'
                    }
                },
                newTitleFilter: {
                    newTitle: {
                        id: 'text',
                        placeholder: 'Filter by new title...'
                    }
                }
            };

            $scope.data.productTable = new NgTableParams({
                count: 10
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
                count: 10
            }, {
                sorting: {
                   title: 'asc'
                },
                getData: function (params) {
                    var filters = angular.copy(params.filter());
                    return $scope.filterRows($scope.data.selectedProducts, filters, params);
                }
            });

            $scope.loadData = function () {
                $scope.state.loading = true;
                ProductService.getProducts($scope.shop).then(function (response) {
                    $scope.state.loadSuccess = response.success;
                    if (response.success) {
                        $scope.data.products = response.data;
                        $scope.data.productTable.reload();
                    } else {
                        $scope.data.errorMsg = response.message;
                    }
                    $scope.state.loading = false;
                });
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
                if ($scope.state.step == 1) {
                    $scope.data.selectedProducts = $scope.data.products.filter(function (product) {
                        return product.selected;
                    }).map(function (product) {
                        product.newTitle = '';
                        return product;
                    });
                    $scope.state.step++;
                    $scope.data.selectedProductTable.filter({});
                    $scope.data.selectedProductTable.reload();
                }
            };

            $scope.loadData();

        }]
    };
});
