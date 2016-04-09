//var shopping = angular.module('shopping', ['ngRoute','ngResource','ngCookies','angular.filter','simplePagination','ui.bootstrap','ngAside','ngTouch','shoppingFlash','simpleAuth','shoppingUserAuth']);
var shopping = angular.module('shopping', ['ngRoute','ngResource','ngCookies','angular.filter','simplePagination','ui.bootstrap']);


shopping.config(function($routeProvider){console.log('Function: config');
    $routeProvider
        .when("/po",{templateUrl: '/app/webroot/js/angular/page/po.html',controller:'addPoController'})
		.when("/po/:id",{templateUrl: '/app/webroot/js/angular/page/po.html',controller:'addPoController'})
		.when("/cart",{templateUrl: '/app/webroot/js/angular/page/cart.html',controller:'cartController'})
		.otherwise({ redirectTo: "/po" });
		
});




shopping.run(function($rootScope,$cookies,$location,$http,$routeParams){ console.log('Function: Run');
	
	var protocol = $location.protocol()+'://';
	var host = $location.host()+'/';
	var path = $location.path();
	console.log(host);
	if(host == '52.4.188.247/')
	$rootScope.filePath = {location:protocol+host+'inventory/'};
	else
	$rootScope.filePath = {location:protocol+host};

	
	$rootScope.cookieCartItems = $cookies.getObject('cart') || 0;
	
	$rootScope.getTotalQty = function(){
		var totalQty = 0;
		var cookievar;
		if($cookies.getObject('cart')){
			for(var i=0; i<$cookies.getObject('cart').items.length ; i++){
				var items = $cookies.getObject('cart').items[i];
				totalQty += parseInt(items.qty);
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
				totalSum += parseInt(items.qty) * parseFloat(items.price).toFixed(2);
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