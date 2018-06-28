ShopFunnelsApp.service('ModalService', ['$uibModal', '$timeout', '$http', '$sce',
    function($uibModal, $timeout, $http, $sce) {

        this.openConfirmModal = function(modalTitle, modalMessage, modalConfirmButtonText, modalCancelButtonText, size) {
            return $uibModal.open({
                'animation': true,
                'size': size,
                'templateUrl': rootUrl + 'src/Front/Angular/views/modalTemplates/confirmTemplate.html',
                'controller': function($scope, $uibModalInstance) {

                    $scope.title = modalTitle;
                    $scope.message = modalMessage;
                    $scope.confirmButtonText = modalConfirmButtonText;
                    $scope.cancelButtonText = modalCancelButtonText;

                    $scope.close = function() {
                        $uibModalInstance.close(false);
                    };

                    $scope.confirm = function() {
                        $uibModalInstance.close(true);
                    };
                }
            });
        };


        this.openGenericModal = function(provider) {
            return $uibModal.open({
                'animation': true,
                'size': provider.size ? provider.size : 'lg',
                'templateUrl': provider.templateUrl,
                'controller': provider.controller,
                'resolve': {
                    'data': function() {
                        return provider.data;
                    }
                }
            });
        };
    }
]);
