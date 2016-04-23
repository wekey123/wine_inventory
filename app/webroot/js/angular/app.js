var shopping = angular.module('shopping', ['ngRoute','ngResource','ngCookies','angular.filter','simplePagination','ui.bootstrap','LocalStorageModule','ui.date']);


shopping.config(function($routeProvider,$locationProvider){console.log('Function: config');

	var host = window.location.host;
	console.log(host);
	if(host == '52.4.188.247'){
	console.log('A');
    $routeProvider
        .when("/po",{templateUrl: '/inventory/app/webroot/js/angular/page/po.html',controller:'addPoController'})
		.when("/cart",{templateUrl: '/inventory/app/webroot/js/angular/page/cart.html',controller:'cartController'})
		.when("/edit/:id",{templateUrl: '/inventory/app/webroot/js/angular/page/po.html',controller:'editPoController'})
		.when("/editcart/:id",{templateUrl: '/inventory/app/webroot/js/angular/page/cart.html',controller:'cartController'})
		.when("/salesadd",{templateUrl: '/inventory/app/webroot/js/angular/page/salesadd.html',controller:'salesAddController'})
		.when("/salesedit/:id",{templateUrl: '/inventory/app/webroot/js/angular/page/salesadd.html',controller:'salesEditController'})
		.otherwise({ redirectTo: "/po" });
	}else{
	console.log('B');
	$routeProvider
        .when("/po",{templateUrl: '/app/webroot/js/angular/page/po.html',controller:'addPoController'})
		.when("/cart",{templateUrl: '/app/webroot/js/angular/page/cart.html',controller:'cartController'})
		.when("/edit/:id",{templateUrl: '/app/webroot/js/angular/page/po.html',controller:'editPoController'})
		.when("/editcart/:id",{templateUrl: '/app/webroot/js/angular/page/cart.html',controller:'editcartController'})
		.when("/salesadd",{templateUrl: '/app/webroot/js/angular/page/salesadd.html',controller:'salesAddController'})
		.when("/salesedit/:id",{templateUrl: '/app/webroot/js/angular/page/salesadd.html',controller:'salesEditController'})
		.otherwise({ redirectTo: "/po" });
	}
		
});




shopping.run(function($rootScope,$cookies,$location,$http,$routeParams){
	 
	console.log('Function: Run');
	$rootScope.cartItems = false;
	var protocol = $location.protocol()+'://';
	var host = $location.host()+'/';
	var path = $location.path();
	
	if(host == '52.4.188.247/'){
		$rootScope.filePath = {location:protocol+host+'inventory/'};
		$rootScope.server = true;
	}else{
		$rootScope.filePath = {location:protocol+host};
		$rootScope.server = false;
	}
	
	$rootScope.cookieCartItems = $cookies.getObject('cart') || 0;
	$rootScope.getTotalQty = function(){
		var totalQty = 0;
		var cookievar;
		if($cookies.getObject('cart')){
			for(var i=0; i<$cookies.getObject('cart').items.length ; i++){
				var items = $cookies.getObject('cart').items[i];
				totalQty += parseInt(items.quantity);
			}
			cookievar = totalQty;
		}else{ 
			cookievar = 0;
		}
		if(cookievar == 0){
			$cookies.remove('cart');
		}
		return cookievar;
	}
	
	$rootScope.getTotalSum = function(){
		var totalSum = 0;
		var cookievar;
		if($cookies.getObject('cart')){
			for(var i=0; i<$cookies.getObject('cart').items.length; i++){
				var items = $cookies.getObject('cart').items[i];
				totalSum += parseInt(items.quantity) * parseFloat(items.price).toFixed(2);
			}
			cookievar = parseFloat($rootScope.roundOfValue(totalSum)).toFixed(2);
		}else{ 
			cookievar = '0.00';
		}
		if(cookievar == '0.00'){
			$cookies.remove('cart');
		}
		return cookievar;
	}
	
	$rootScope.roundOfValue = function(value){
	 return Math.round(value * 100) / 100;	
	}
	
});

shopping.directive("datepicker", function () {
  return {
    restrict: "A",
    require: "ngModel",
    link: function (scope, elem, attrs, ngModelCtrl) {
      var updateModel = function (dateText) {
        scope.$apply(function () {
          ngModelCtrl.$setViewValue(dateText);
        });
      };
      var options = {
        dateFormat: "dd/mm/yy",
        onSelect: function (dateText) {
          updateModel(dateText);
        }
      };
      elem.datepicker(options);
    }
  }
});