ShopFunnelsApp.service('HomeService', ['$q', '$http',
    function($q, $http) {
        this.rootUrl = rootUrl;

        this.verifyStore = function (storeName) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/verify-store?storeName=' + storeName,
                method: 'GET'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.authorize = function (storeName) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/authorize?storeName=' + storeName,
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
