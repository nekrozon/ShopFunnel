ShopFunnelsApp.service('ProductService', ['$q', '$http',
    function($q, $http) {
        this.rootUrl = rootUrl;

        this.getProducts = function (shop) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-products?shop=' + shop,
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
