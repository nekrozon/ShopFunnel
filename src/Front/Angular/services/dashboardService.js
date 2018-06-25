ShopFunnelsApp.service('DashboardService', ['$q', '$http',
    function($q, $http) {
        this.rootUrl = rootUrl;

        this.getInitData = function () {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-dashboard-data',
                method: 'GET'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.getProducts = function () {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-products',
                method: 'GET'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.getOrders = function () {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-orders',
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
