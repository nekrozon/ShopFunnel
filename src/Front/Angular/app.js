'use strict';

var ShopFunnelsApp = angular.module('ShopFunnelsApp', ['ngMaterial', 'ngMessages', 'ngclipboard', 'ui.bootstrap', 'ngTable', 'ui.sortable', 'checklist-model', 'angular-loading-bar']);

angular.module('ShopFunnelsApp').config(function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.spinnerTemplate = '<div id="loading-bar-spinner"><div class="spinner-icon"></div></div>';
    cfpLoadingBarProvider.loadingBarTemplate = '<div class="loading-bar-overlay"><div id="loading-bar"><div class="bar"><div class="peg"></div></div></div></div>';
});
