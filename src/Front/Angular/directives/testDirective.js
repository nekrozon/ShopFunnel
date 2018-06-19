ShopFunnelsApp.directive('testDirective', function() {
    return {
        scope: {
            'sample': '='
        },
        restrict: 'E',
        replace: 'true',
        templateUrl: rootUrl + 'src/Front/Angular/views/directives/testDirectiveTemplate.html',
        controller: ['$scope', function($scope) {

        }]
    };
});
