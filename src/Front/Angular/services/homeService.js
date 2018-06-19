ShopFunnelsApp.service('HomeService', ['$q', '$http',
    function($q, $http) {
        this.rootUrl = rootUrl;

        this.testAction = function (fakeData) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/test',
                method: 'GET'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };
    }
]);
