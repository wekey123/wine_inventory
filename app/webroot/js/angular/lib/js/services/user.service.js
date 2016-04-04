(function () {
    'use strict';

    angular
        .module('shoppingUserAuth',[])
        .factory('UserService', UserService);

    UserService.$inject = ['$http'];
    function UserService($http,$cookieStore) {
        var service = {};

        service.GetAll = GetAll;
        service.GetById = GetById;
        service.GetByUsername = GetByUsername;
        service.Create = Create;
        service.Update = Update;
        service.Delete = Delete;

        return service;

        function GetAll() {
            return $http.get('/api/users').then(handleSuccess, handleError('Error getting all users'));
        }

        function GetById(id) {
            return $http.get('/api/users/' + id).then(handleSuccess, handleError('Error getting user by id'));
        }

        function GetByUsername(User) {
            return $http.post('users/login.json',User).then(handleSuccess, handleError('Error getting user by username'));
        }

        function Create(user) {
			var cred ={};	cred['User'] = user;
            return $http.post('users/registration.json', cred).then(handleSuccess, handleError('Error creating user'));
        }

        function Update(user,userCookie) {
			var cred ={};	cred['User'] = user;
            return $http.put('users/updateProfile.json', cred,{headers: {'userSession': userCookie}}).then(handleSuccess, handleError('Error updating user'));
        }

        function Delete(id) {
            return $http.delete('/api/users/' + id).then(handleSuccess, handleError('Error deleting user'));
        }

        // private functions

        function handleSuccess(res) {
            return res.data;
        }

        function handleError(error) {
            return function () {
                return { success: false, message: error };
            };
        }
    }

})();
