'use strict';

ShopFunnelsApp.controller('BaseController', ['$scope', 'orderByFilter', 'filterFilter',
    function($scope, orderBy, filter) {

        $scope.data = {};
        $scope.state = {};

        angular.element(document).ready(function() {
            $("form").each(function() {
                $(this).validate({
                    rules: {
                        email: {
                            overwrittenEmail: true,
                            email: false
                        }
                    },
                    showErrors: function (errorMap, errorList) {
                        $.each(this.successList, function (index, value) {
                            return $(value).popover("hide");
                        });

                        $.each(errorList, function (index, value) {
                            var _popover;
                            _popover = $(value.element).popover({
                                trigger: "manual",
                                placement: "bottom",
                                content: value.message,
                                template: "<div class=\"popover\"><div class=\"arrow\"></div><div class=\"popover-inner\"><div class=\"popover-content\"><p></p></div></div></div>"
                            });
                            _popover.data("bs.popover").options.content = value.message;
                            return $(value.element).popover("show");
                        });
                    }
                });
            });
        });

        $scope.filterRows = function (rows, filters, params) {
            if (typeof rows == 'undefined') {
                return [];
            }

            if (typeof rows.length == 'undefined' && typeof rows == 'object') {
                var arrRows = [];
                angular.forEach(rows, function (row) {
                    arrRows.push(row);
                });
                rows = arrRows;
            }

            rows = filter(rows, filters);
            var sorting = params.sorting();
            var key = Object.keys(sorting)[0];
            if (key) {
                rows = orderBy(rows, key, sorting[key] == 'desc');
            }
            params.total(rows.length);

            return rows.slice((params.page() - 1) * params.count(), params.page() * params.count());
        };
    }
]);
