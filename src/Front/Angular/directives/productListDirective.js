ShopFunnelsApp.directive('productList', function() {
    return {
        scope: {
            'shop': '='
        },
        restrict: 'E',
        replace: 'true',
        template: '<h2>Products of {{shop}}</h2>',
        controller: ['$scope', function($scope) {
          
        }]
    };
});
