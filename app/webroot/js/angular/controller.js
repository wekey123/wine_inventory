shopping.controller("addPoController", ["$scope","$log","$timeout","$http",'$rootScope','$cookies','$filter','cartService','$routeParams','$location', function ($scope, $log, $timeout, $http,$rootScope,$cookies,$filter,cartService,$routeParams,$location) {console.log('Function: addPoController');

	$scope.cookieCartItems = cartService.checkCookieBeforeAdd();
	$scope.cartVendorName = cartService.getVendorName();
	$scope.allProducts = '{}';
	$scope.loader = true;
	$scope.validationError = '';
	$scope.url = $rootScope.filePath.location+'orders/apiAddProducts.json';
	$http({method: 'GET',url: $scope.url,cache: false
	 }).success(function (data, status, headers, config) {
	    $scope.allProducts = data.products;
		$scope.vendor = [];
		$scope.category = [];
		$scope.product = [];
		$scope.allProducts = data.products;
		angular.forEach($scope.allProducts, function(category, vendorkey) {
			$scope.vendor.push({'vendorName':vendorkey});
			angular.forEach(category, function(productObj, categoryKey) {
				$scope.category.push({'categoryName':categoryKey,'vendorName':vendorkey});
				angular.forEach(productObj.Product, function(prod, key) {
					$scope.prod = prod;
					 if($scope.cookieCartItems){
						var i=0, len=$scope.cookieCartItems.length;
						for (; i<len; i++) {
						   if(parseInt($scope.cookieCartItems[i].id) === parseInt($scope.prod.pv_id)){
							  $scope.prod.quantity = parseInt($scope.cookieCartItems[i].quantity);
							  $scope.prod.price = parseFloat($scope.cookieCartItems[i].price);
							  $scope.prod.sum = parseFloat($scope.cookieCartItems[i].sum);
						   }
						}
					}
					$scope.product.push($scope.prod);	
				});
			});
		});
		$scope.selectedVendor = $scope.vendor[0]['vendorName'];
		//console.log($scope.vendor);
		//console.log($scope.category);
		//console.log($scope.product);	
		//return false;
	 }).error(function (data, status, headers, config) {
	   $scope.loader = false;
	});
	
	 /*Vendor Filter to category*/
 	 $scope.categoryFilterExpression = function(categoryList) {
		if($scope.selectedVendor === 'all'){
			 return categoryList;
		}
        return (categoryList.vendorName === $scope.selectedVendor );
     };
	/*Vendor Filter to product*/ 
	 $scope.productFilterExpression = function(productList) {
		if($scope.selectedVendor === 'all'){
			 return productList;
		}
        return (productList.vendor === $scope.selectedVendor);
     };
	
	
	/*Category Filter*/
	 $scope.selectedCategory = [];
	 /*Select Category*/
	 $scope.checkCategory = function(cat) {
        var i = $.inArray(cat, $scope.selectedCategory);
        if (i > -1) {
            $scope.selectedCategory.splice(i, 1);
        } else {
            $scope.selectedCategory.push(cat);
        }
    }

	/*Category filter with product*/
	$scope.categoryProductFilterExpression = function(productList) {
		
        if ($scope.selectedCategory.length > 0) {
            if ($.inArray(productList.category, $scope.selectedCategory) < 0)
                return;
        }
        
        return productList;
    }
	/*Category*/
	
	
	/*pagination*/
	$scope.currentPage = 0;
    $scope.pageSize = 10;
	$scope.filteredItemsLen = function() {
        return ($scope.filteredItems || []).length;  
    };
    $scope.numberOfPages=function(){
        return Math.ceil($scope.filteredItemsLen()/$scope.pageSize);                
    }
	/*pagination*/
	
	 $scope.addToCart = function(object,option) {
		 console.log('A');
		 console.log($scope.cartVendorName);
		if(!$scope.cartVendorName || !$scope.cookieCartItems){
			 cartService.setVendorName(object.vendor);
			 $scope.cartVendorName = cartService.getVendorName();
		}
		 console.log('B');
		 console.log($scope.cartVendorName);
		if($scope.cartVendorName != object.vendor){
		    $scope.validationError = "Please Select Same Vendor Products"; 
			return false;
		}
	    if (typeof object.quantity != 'undefined'){
			if(object.quantity  != '' && object.price != ''){	
			
				$scope.addData = {vendor_id: parseInt(object.vendor_id),vendor: object.vendor,category_id: parseInt(object.vendor_type),category: object.category, id: parseInt(object.pv_id), p_id: parseInt(object.id), title: object.title, size: object.variant, metric: object.metric, qty_type: object.qty_type, qty: object.qty, price: parseFloat(object.price), quantity: parseInt(object.quantity), img: object.image, sum: parseFloat(object.sum)};
				console.log($scope.addData);
				cartService.addCart($scope.addData);
				$scope.validationError = "";
			 }else{
				$scope.validationError = "Please Enter Price and Quantity"; 
			 }
		}else{
			$scope.validationError = "Please Enter Price and Quantity";
		}
		
	 }

	 $scope.roundOfValue = function(a){ // a - row sum of price and quantity
		  return cartService.roundOfValue(a);
	 }
}]);



<!--CART Controller Code Starts-->


shopping.controller('cartController',['$scope','$routeParams','$http','$cookies','$filter','$rootScope','$log','cartService',function($scope, $routeParams, $http,$cookies,$filter,$rootScope,$log,cartService){console.log('Function: cartController');

	 $scope.cartItem = cartService.getCartItems();
	 
	  $scope.updateToCart = function(object) {
		  console.log(object);
	    if (typeof object.quantity != 'undefined'){
			if(object.quantity  != '' && object.price != ''){	
				$scope.addData = {vendor: object.vendor, category: object.category, id: parseInt(object.id), title: object.title, price: parseFloat(object.price), quantity: parseInt(object.quantity), img: object.img, sum: parseFloat(object.sum)};
				cartService.addCart($scope.addData);
				$scope.validationError = "";
			 }else{
				$scope.validationError = "Please Enter Price and Quantity"; 
			 }
		}else{
			$scope.validationError = "Please Enter Price and Quantity";
		}
		
	 }
	 
	 $scope.updateCart = function(a,b){ // a - qty_sum  b - toal_sum
		 cartService.updateCart(a,b);
	 }
	
	 $scope.removeCart = function(a){ // a - remove id;
		 cartService.removeCart(a);
	 }
	 $scope.roundOfValue = function(a){ // a - row sum of price and qty
		  return cartService.roundOfValue(a);
	 }
	 $scope.cartTotalSum = function(){
		 return cartService.cartTotalSum();
	 }
	
	$scope.cartTotalQty = function(){
		return cartService.cartTotalQty();
	 }
	 
	 $scope.addMoreQty = function(itm,index){
		 cartService.addMoreQty(itm,index);
	 }
	 
	 $scope.removeMoreQty = function(itm,index){
		 cartService.removeMoreQty(itm,index);
	 }
	 
	  $scope.submitCart = function(type){

		 $scope.loader = true;
		 $scope.postdata = $cookies.getObject('cart');
		 $scope.postdata.cartQty = $scope.cartTotalQty();
         $scope.postdata.cartSum = $scope.cartTotalSum();
		 $scope.postdata.vendor = cartService.getVendorName();
		 $scope.postdata.poNo = $cookies.getObject('cart').items[0].po_no;
		 if(type == 'submit')
		 $scope.postdata.type = '1'; //submitted
		 else
		  $scope.postdata.type = 'pending';//  pending
		  console.log($scope.postdata);
		  console.log($scope.postdata.poNo);
		if($scope.postdata.poNo)
			$scope.url = $rootScope.filePath.location+'orders/addcart/'+$scope.postdata.poNo+'.json';
		else
	  		$scope.url = $rootScope.filePath.location+'orders/addcart.json';
			console.log($scope.url);
		 //return false;
		 $http({method: 'POST',url: $scope.url,data :$scope.postdata,cache: false}).success(function (data, status, headers, config) {
			 console.log(data);
			 if(data.responseCart.response !== 'E'){
				 console.log(data.responseCart.message);
				 cartService.unSetCartItems();
				 if($rootScope.server)
					 window.location = "/inventory/orders";
				 else
					 window.location = "/orders";
			 }else{
				 console.log(data);
			 }
		}).error(function (data, status, headers, config) {
		   $scope.loader = false;
		}); 
	  }
	
}]);