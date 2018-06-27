'use strict';

ShopFunnelsApp.controller('DashboardController', ['$scope', '$controller', 'NgTableParams', 'DashboardService', 'ModalService',
    function ($scope, $controller, NgTableParams, DashboardService, ModalService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.loadData = function () {
            $scope.state.loading = true;
            DashboardService.getInitData().then(function (response) {
                $scope.data = response;
                $scope.data.webhookLogs = [
                    {
                        id: 1,
                        name: 'Midnight Point - Fishing Charter',
                        url: 'https://webhook.apptrends.com/click-funnels/aa6eb946-44a4-4a79-aaf0-b04424928006',
                        orders: 4,
                        queued: 1,
                        type: {
                            id: 2,
                            label: 'Test'
                        }
                    }
                ];
                $scope.webhookLogTable.reload();
                if (response.success) {
                    $scope.funnelFormTable.reload();
                    $scope.orderTable.reload();
                    $scope.productTable.reload();
                } else {
                    toastr.error(response.errorMsg);
                }
                $scope.state.loading = false;
            });
        };

        $scope.clipboardCopied = function () {
            toastr.success('Clipboard copied');
        };

        // ********************* Product forms tab methods *********************

        $scope.funnelFormTable = new NgTableParams({
            count: 10
        }, {
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.funnelForms, filters, params);
            }
        });

        $scope.openMenu = function ($mdMenu, event) {
            $mdMenu.open(event);
        };

        $scope.logout = function () {
            window.location.href = rootUrl + 'login/logout';
        };

        $scope.gotoHome = function () {
            window.location.href = rootUrl;
        };

        $scope.reloadFunnelForm = function (funnelForm) {

        };

        $scope.openFunnelFormSettings = function (funnelForm) {
            var modal = ModalService.openGenericModal({
                size: 'md',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/funnelFormSettingsModalTemplate.html',
                controller: 'FunnelFormSettingsModalController',
                data: {
                    funnelForm: funnelForm,
                    static: $scope.data.static
                }
            });

            modal.result.then(function (response) {
            });
        };

        $scope.refreshFunnelForms = function () {

        };

        $scope.addFunnelForm = function () {
            var modal = ModalService.openGenericModal({
                size: 'md',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/newFunnelFormModalTemplate.html',
                controller: 'NewFunnelFormModalController',
                data: {
                    static: $scope.data.static
                }
            });

            modal.result.then(function (response) {
            });
        };

        $scope.getFormTypeLabel = function (typeId) {
            var label = '-';
            if (typeId == $scope.data.static.constants.funnelFormTypeEnum.CUSTOM_FORM) {
                label = 'Custom Form';
            } else if (typeId == $scope.data.static.constants.funnelFormTypeEnum.TWO_STEP_FORM) {
                label = 'Two Step Form';
            }

            return label;
        };

        // ********************* Product forms tab methods *********************

        // ************************ Orders tab methods *************************

        $scope.selectedOrderType = 'live';
        $scope.orderTable = new NgTableParams({
            count: 10
        }, {
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.orders, filters, params);
            }
        });

        $scope.refreshOrders = function () {
            DashboardService.getOrders().then(function (response) {
                if (response.success) {
                    $scope.data.orders = response.orders;
                    $scope.orderTable.reload();
                } else {
                    toastr.error(response.errorMsg);
                }
            });
        };

        $scope.seeOrdersByType = function (type) {

        };

        $scope.openOrderDetails = function (order) {
            if (!order.productsLoaded) {
                for (var i in order.products) {
                    for (var j in $scope.data.products) {
                        if (order.products[i].id == $scope.data.products[j].id) {
                            order.products[i].name = $scope.data.products[j].name;
                            order.products[i].image = $scope.data.products[j].image;
                            break;
                        }
                    }
                }
                order.productsLoaded = true;
            }

            var modal = ModalService.openGenericModal({
                size: 'lg',
                templateUrl: rootUrl + 'src/Front/Angular/views/modalTemplates/orderDetailModalTemplate.html',
                controller: 'OrderDetailModalController',
                data: {
                    order: order
                }
            });

            modal.result.then(function (response) {
            });
        };

        // ************************ Orders tab methods *************************

        // *********************** Products tab methods ************************

        $scope.productTable = new NgTableParams({
            count: 10
        }, {
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.products, filters, params);
            }
        });

        $scope.refreshProducts = function () {
            DashboardService.getProducts().then(function (response) {
                if (response.success) {
                    $scope.data.products = response.products;
                    $scope.productTable.reload();
                } else {
                    toastr.error(response.errorMsg);
                }
            });
        };

        // *********************** Products tab methods ************************

        // ********************* Webhook logs tab methods **********************

        $scope.selectedFormType = 'test';
        $scope.webhookLogTable = new NgTableParams({
            count: 10
        }, {
            getData: function (params) {
                var filters = angular.copy(params.filter());

                return $scope.filterRows($scope.data.webhookLogs, filters, params);
            }
        });

        $scope.seeWebhookLogsByType = function (type) {

        };

        $scope.refreshWebhookLogs = function () {

        };

        // ********************* Webhook logs tab methods **********************

        // *********************** Settings tab methods ************************
        // *********************** Settings tab methods ************************

        $scope.loadData();

    }
]);
