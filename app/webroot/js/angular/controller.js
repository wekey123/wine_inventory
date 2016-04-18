shopping.controller("addPoController", ["$scope","$log","$timeout","$http",'$rootScope','$cookies','$filter','cartService','$routeParams','$location', function ($scope, $log, $timeout, $http,$rootScope,$cookies,$filter,cartService,$routeParams,$location) {console.log('Function: addPoController');

	if(!$rootScope.cartItems){
		$scope.cookieCartItems = 0;
		$scope.cartVendorName = '';
	}
	else{
		$scope.cookieCartItems = cartService.checkCookieBeforeAdd();
		$scope.cartVendorName = cartService.getVendorName();
	}
	$scope.addCart = true;
	$scope.editCart = false;
	$scope.allProducts = '{}';
	$scope.loader = true;
	$scope.validationError = '';
	$scope.showProduct = false;
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
				$scope.category.push({'categoryName':categoryKey,'vendorName':vendorkey,'categoryNamebox':false});
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
		
		if(!$scope.cartVendorName)
		$scope.selectedVendor = $scope.vendor[0]['vendorName'];
		else
		$scope.selectedVendor = $scope.cartVendorName;
		//console.log($scope.vendor);
		//console.log($scope.category);
		//console.log($scope.product);	
		//return false;
	 }).error(function (data, status, headers, config) {
	   $scope.loader = false;
	});
	
	$scope.selectedCategory = [];
	
	$scope.changeCategory = function(){
		 angular.forEach($scope.category, function(cat, key) {
			$scope.category[key].categoryNamebox = false;
			$scope.showProduct = false;
			$scope.selectedCategory = [];
		}); 
	};
	
	
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
	 /*Select Category*/
	 $scope.checkCategory = function(cat) {
		 console.log('checkCategory');
		 console.log(cat); 
		 
        var i = $.inArray(cat, $scope.selectedCategory);
        if (i > -1) {
			$scope.showProduct = true;
            $scope.selectedCategory.splice(i, 1);
        } else {
			$scope.showProduct = true;
            $scope.selectedCategory.push(cat);
        }
    }

	/*Category filter with product*/
	$scope.categoryProductFilterExpression = function(productList) {
        if ($scope.selectedCategory.length > 0) {
            if ($.inArray(productList.category, $scope.selectedCategory) < 0)
                return;
        }else{
			$scope.showProduct = false;
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
			
				$scope.addData = {vendor_id: parseInt(object.vendor_id),vendor: object.vendor,category_id: parseInt(object.vendor_type),category: object.category, id: parseInt(object.pv_id), p_id: parseInt(object.id), title: object.title, size: object.variant, metric: object.metric, qty_type: object.qty_type, qty: object.qty, price: parseFloat(object.price), quantity: parseInt(object.quantity), old_quantity: parseInt(object.quantity), img: object.image, sum: parseFloat(object.sum)};
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
	 
	 $scope.getTotalSum = function(){
		 return cartService.cartTotalSum();
	 }
	
	 $scope.getTotalQty = function(){
		return cartService.cartTotalQty();
	 }
	 

	 $scope.roundOfValue = function(a){ // a - row sum of price and quantity
		  return cartService.roundOfValue(a);
	 }
}]);



<!--CART Controller Code Starts-->


shopping.controller('cartController',['$scope','$routeParams','$http','$cookies','$filter','$rootScope','$log','cartService',function($scope, $routeParams, $http,$cookies,$filter,$rootScope,$log,cartService){console.log('Function: cartController');

 	  $rootScope.cartItems = true;
	  $scope.cartItem = cartService.getCartItems();
	  $scope.editCart = false;
	  $scope.addCart = true;
	  $scope.updateToCart = function(object) {
		  console.log(object);
	    if (typeof object.quantity != 'undefined'){
			if(object.quantity  != '' && object.price != ''){	
				// $scope.addData = {vendor_id: parseInt(object.vendor_id),vendor: object.vendor,category_id: parseInt(object.vendor_type),category: object.category, id: parseInt(object.pv_id), p_id: parseInt(object.id), title: object.title, size: object.variant, metric: object.metric, qty_type: object.qty_type, qty: object.qty, price: parseFloat(object.price), quantity: parseInt(object.quantity), old_quantity: parseInt(object.quantity), img: object.image, sum: parseFloat(object.sum)};
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
	 
	$scope.getTotalSum = function(){
		 return cartService.cartTotalSum();
	 }
	
	 $scope.getTotalQty = function(){
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
		 $scope.postdata.poCopy = $scope.storepo;
		 //console.log($scope.postdata); return false;
		 if(type == 'submit'){
		 $scope.postdata.type = '1'; //submitted
			 if($scope.postdata.poOrder == true){
				 $scope.postdata.type = '10';
			 }
		 }else
		  $scope.postdata.type = 'pending';//  pending
		  console.log($scope.postdata);
		  console.log($scope.postdata.poNo);
		if($scope.postdata.poNo)
			$scope.url = $rootScope.filePath.location+'orders/addcart/'+$scope.postdata.poNo+'.json';
		else
	  		$scope.url = $rootScope.filePath.location+'orders/addcart.json';
			console.log($scope.url);

		 $http({method: 'POST',url: $scope.url,data :$scope.postdata,cache: false}).success(function (data, status, headers, config) {
			 if(data.responseCart.response !== 'E'){
				 console.log(data.responseCart);
				 cartService.unSetCartItems();
				 if(data.responseCart.status == 0){
					 if($rootScope.server)
						 window.location = "/inventory/orders";
					 else
						 window.location = "/orders";
				 }if(data.responseCart.status == 10){
					  var po = data.responseCart.orderID;
					 if($rootScope.server)
						 window.location = "/inventory/invoices/edit/"+po;
					 else
						 window.location = "/invoices/edit/"+po;
				 }else{
					 var po = data.responseCart.orderID;
					 if($rootScope.server)
						 window.location = "/inventory/orders/report/"+po+"/email";
					 else
						 window.location = "/orders/report/"+po+"/email";
				 }
			 }else{
				 console.log(data);
			 }
		}).error(function (data, status, headers, config) {
		   $scope.loader = false;
		}); 
	  }
	
}]);