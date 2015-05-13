'use strict';

var appControllers = angular.module('appControllers', []);

appControllers.controller('PhoneTypesCtrl', ['$scope', '$log', 'phoneTypesProvider', 
    function($scope, $log, phoneTypesProvider) {
    
        $scope.phoneTypes = [];

        $scope.phonetype = '';
        $scope.active = '';

        $scope.update = false;

        $scope.updatephonetypeid = '';
        $scope.updatephonetype = '';
        $scope.updateactive = '';

        $scope.addPhoneType = function() {

            phoneTypesProvider.postPhoneType($scope.phonetype, $scope.active).success(function(response) {
                $log.log(response);
                getPhoneTypes();
            }).error(function (response, status) {
               $log.log(response);
            });                

        };


        $scope.showUpdate = function(index) {

            var phonetype = $scope.phoneTypes[index];

            $scope.updatephonetypeid = phonetype.phonetypeid;
            $scope.updatephonetype = phonetype.phonetype;
            $scope.updateactive = phonetype.active;
            $scope.update = true;

        };

        $scope.updatePhoneType = function() {

            phoneTypesProvider.updatePhoneType($scope.updatephonetypeid, $scope.updatephonetype, $scope.updateactive).success(function(response) {
                $log.log(response);
                getPhoneTypes();
            }).error(function (response, status) {
               $log.log(response);
            });   

            $scope.update = false;
        };


        $scope.deletePhoneType = function(phonetypeid) {

            phoneTypesProvider.deletePhoneType(phonetypeid).success(function(response) {
                $log.log(response);
                getPhoneTypes();
            }).error(function (response, status) {
               $log.log(response);
            });        
        };


        function getPhoneTypes() {    
            phoneTypesProvider.getPhoneTypes().success(function(response) {
                $scope.phoneTypes = response.data;
            }).error(function (response, status) {
               $log.log(response);
            });
        };

        getPhoneTypes();
    
    
}])

.controller('PhonesCtrl', ['$scope', '$log', 'phonesProvider', 'phoneTypesProvider',
    function($scope, $log, phonesProvider, phoneTypesProvider) {
    
        $scope.phones = [];
        $scope.phoneTypes = [];
        
        
        $scope.phone = '';
        $scope.active = '';
        $scope.phonetype = '';
        
        
        $scope.update = false;

        $scope.updatephoneid = '';
        $scope.updatephone = '';
        $scope.updatephonetype = '';
        $scope.updateactive = '';
        
        
        $scope.addPhone = function() {

            phonesProvider.postPhone($scope.phone, $scope.phonetype.phonetypeid, $scope.active).success(function(response) {
                $log.log(response);
                getPhones();
            }).error(function (response, status) {
               $log.log(response);
            });                

        };
        
        $scope.showUpdate = function(index) {

            var phone = $scope.phones[index];

            $scope.updatephoneid = phone.phoneid;
            $scope.updatephone = phone.phone;
            $scope.updatephonetype = getPhoneType(phone.phonetypeid);
            $scope.updateactive = phone.active;
            $scope.update = true;

        };
        
        
        function getPhoneType(id) {
            var i = $scope.phoneTypes.length;
            
            while ( i-- ) {
                if ( $scope.phoneTypes[i].phonetypeid === id ) {
                    break;
                }
            }
            
           return $scope.phoneTypes[i]; 
        };

        $scope.updatePhone = function() {

            phonesProvider.updatePhone($scope.updatephoneid, $scope.updatephone, $scope.updatephonetype.phonetypeid, $scope.updateactive).success(function(response) {
                $log.log(response);
                getPhones();
            }).error(function (response, status) {
               $log.log(response);
            });   

            $scope.update = false;
        };
        
        $scope.deletePhone = function(phoneid) {

            phonesProvider.deletePhone(phoneid).success(function(response) {
                $log.log(response);
                getPhones();
            }).error(function (response, status) {
               $log.log(response);
            });        
        };
       
        
        function getPhones() {   
            phonesProvider.getPhones().success(function(response) {
                 $scope.phones = response.data;              
            }).error(function (response, status) {
               $log.log(response);
            });  
        };
        
        getPhones();
        
        phoneTypesProvider.getPhoneTypes().success(function(response) {
            $scope.phoneTypes = response.data;
            $scope.phonetype = $scope.phoneTypes[0];
        }).error(function (response, status) {
           $log.log(response);
        });
    
}]);




