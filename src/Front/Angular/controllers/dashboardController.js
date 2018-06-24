'use strict';

ShopFunnelsApp.controller('DashboardController', ['$scope', '$controller', 'NgTableParams', 'DashboardService',
    function ($scope, $controller, NgTableParams, DashboardService) {

        angular.extend(this, $controller('BaseController', {$scope: $scope}));

        $scope.loadData = function () {
            $scope.state.loading = true;
            DashboardService.getInitData().then(function (response) {
                $scope.data = response;
                $scope.data.funnelForms = [
                    {
                        id: 1,
                        name: 'Midnight Point Coder - Need a Break Tee',
                        type: {
                            id: 1,
                            label: 'Custom form'
                        },
                        script: '<script src="http://dev.shopfunnelapp.com/scripts/8815692601616000161.js"></script>',
                        loaded: true,
                        updatedAt: '6/7/2018, 4:28:07 PM'
                    },
                    {
                        id: 2,
                        name: 'Midnight Point Coder - Need a Break Tee - Legacy',
                        type: {
                            id: 1,
                            label: 'Custom form'
                        },
                        script: '<script src="http://dev.shopfunnelapp.com/scripts/8815692601616000161.js"></script>',
                        loaded: true,
                        updatedAt: '6/10/2018, 10:21:33 PM'
                    },
                    {
                        id: 3,
                        name: 'Test custom form by krunal',
                        type: {
                            id: 1,
                            label: 'Custom form'
                        },
                        script: '<script src="http://dev.shopfunnelapp.com/scripts/8815692601616000161.js"></script>',
                        loaded: false,
                        updatedAt: '6/10/2018, 10:27:33 PM'
                    },
                    {
                        id: 4,
                        name: 'Test form by Krunal',
                        type: {
                            id: 2,
                            label: 'Two step form'
                        },
                        script: '<script src="http://dev.shopfunnelapp.com/scripts/8815692601616000161.js"></script>',
                        loaded: false,
                        updatedAt: '6/10/2018, 10:27:08 PM'
                    },
                    {
                        id: 5,
                        name: 'Tst Funnel',
                        type: {
                            id: 1,
                            label: 'Custom form'
                        },
                        script: '<script src="http://dev.shopfunnelapp.com/scripts/8815692601616000161.js"></script>',
                        loaded: true,
                        updatedAt: '6/10/2018, 10:26:42 PM'
                    }
                ];
                $scope.data.orders = [
                    {
                        number: 182152,
                        customer: {
                            name: 'as',
                            email: 'as@gmail.com'
                        },
                        status: {
                            id: 1,
                            label: 'Paid'
                        },
                        price: '254.90',
                        quantity: 2,
                        submitStatus: {
                            id: 1,
                            label: 'Yes'
                        },
                        updatedAt: '6/10/2018, 10:30:24 AM'
                    },
                    {
                        number: 180773,
                        customer: {
                            name: 'AA',
                            email: 'onefire2018@gmail.com'
                        },
                        status: {
                            id: 1,
                            label: 'Paid'
                        },
                        price: '209.92',
                        quantity: 4,
                        submitStatus: {
                            id: 1,
                            label: 'Yes'
                        },
                        updatedAt: '6/9/2018, 12:10:33 AM'
                    },
                    {
                        number: 180322,
                        customer: {
                            name: 'Soft World',
                            email: 'softworld783@gmail.com'
                        },
                        status: {
                            id: 1,
                            label: 'Paid'
                        },
                        price: null,
                        quantity: 2,
                        submitStatus: {
                            id: 3,
                            label: 'Pending'
                        },
                        updatedAt: '6/8/2018, 3:10:23 PM'
                    },
                    {
                        number: 180217,
                        customer: {
                            name: 'Soft World',
                            email: 'softworld783@gmail.com'
                        },
                        status: {
                            id: 1,
                            label: 'Paid'
                        },
                        price: '29.99',
                        quantity: 2,
                        submitStatus: {
                            id: 1,
                            label: 'Yes'
                        },
                        updatedAt: '6/8/2018, 1:15:38 PM'
                    },
                    {
                        number: 179299,
                        customer: {
                            name: 'Ry',
                            email: 'ohyea@gmail.com'
                        },
                        status: {
                            id: 1,
                            label: 'Paid'
                        },
                        price: '74.97',
                        quantity: 2,
                        submitStatus: {
                            id: 1,
                            label: 'Yes'
                        },
                        updatedAt: '6/7/2018, 2:40:27 PM'
                    }
                ];
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
                $scope.funnelFormTable.reload();
                $scope.orderTable.reload();
                $scope.webhookLogTable.reload();
                if (response.success) {
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

        };

        $scope.refreshFunnelForms = function () {

        };

        $scope.addFunnelForm = function () {

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

        $scope.seeOrdersByType = function (type) {

        };

        $scope.refreshOrders = function () {

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
