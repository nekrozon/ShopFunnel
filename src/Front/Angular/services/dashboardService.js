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

        this.getFunnelForms = function () {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-forms',
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

        this.createForm = function (formData) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/create-form',
                method: 'POST',
                data: {
                    formData: formData
                }
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.deleteForm = function (formId) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/delete-form/' + formId,
                method: 'DELETE'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.updateForm = function (formData) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/update-form',
                method: 'POST',
                data: {
                    formData: formData
                }
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.deleteProduct = function (productId) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/delete-product/' + productId,
                method: 'DELETE'
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.updateProduct = function (productData) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/update-product',
                method: 'POST',
                data: {
                    productData: productData
                }
            }).then(function (response) {
                deferred.resolve(response.data);
            }, function (error) {
                deferred.reject(error.data);
            });

            return deferred.promise;
        };

        this.getFormProducts = function (formId) {
            var deferred = $q.defer();

            $http({
                url: this.rootUrl + 'api/get-form-products/' + formId,
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
