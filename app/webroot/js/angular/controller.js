shopping.controller('cartController',['$scope','$routeParams','$http','$cookies','$filter','$rootScope','$log','cartService',function($scope, $routeParams, $http,$cookies,$filter,$rootScope,$log,cartService){
	
	 $scope.cartItem = cartService.getCartItems();
	 
	  $scope.updateToCart = function(object) {
		  console.log(object);
	    if (typeof object.qty != 'undefined'){
			if(object.qty  != '' && object.price != ''){	
				$scope.addData = {vendor: object.vendor, category: object.category, id: parseInt(object.id), title: object.title, price: parseFloat(object.price), qty: parseInt(object.qty), img: object.img, sum: parseFloat(object.sum)};
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
		 if(type == 'submitCart')
		 $scope.postdata.type = '1'; //submitted
		 else
		  $scope.postdata.type = 'pending';//  pending
		  
		 $http({method: 'POST',url: 'http://192.168.1.105/orders/addcart.json',data :$scope.postdata,cache: false}).success(function (data, status, headers, config) {
			console.log(data);
		}).error(function (data, status, headers, config) {
		   $scope.loader = false;
		}); 
	  }
	
}]);


shopping.controller("addPoController", ["$scope","$log","$timeout","$http",'$rootScope','$cookies','$filter','cartService', function ($scope, $log, $timeout, $http,$rootScope,$cookies,$filter,cartService) {
	
	$scope.cookieCartItems = cartService.checkCookieBeforeAdd();
	$scope.allProducts = '{}';
	$scope.loader = true;
	$scope.validationError = '';
	
	$http({method: 'GET',url: '/orders/apiAddProducts.json',cache: false
	 }).success(function (data, status, headers, config) {
	    $scope.allProducts = data.products;
		$scope.vendor = [];
		$scope.category = [];
		$scope.product = [];
		angular.forEach($scope.allProducts, function(category, vendorkey) {
			$scope.vendor.push({'vendorName':vendorkey});
			angular.forEach(category, function(productObj, categoryKey) {
				$scope.category.push({'categoryName':categoryKey,'vendorName':vendorkey});
				angular.forEach(productObj.Product, function(prod, key) {
					$scope.prod = prod;
					if($scope.cookieCartItems){
						var i=0, len=$scope.cookieCartItems.length;
						for (; i<len; i++) {
						   if(parseInt($scope.cookieCartItems[i].id) === parseInt($scope.prod.vid)){
							  $scope.prod.qty = parseInt($scope.cookieCartItems[i].qty);
							  $scope.prod.price = parseFloat($scope.cookieCartItems[i].price);
							  $scope.prod.sum = parseFloat($scope.cookieCartItems[i].price);
						   }
						}
					}
					
					$scope.product.push($scope.prod);
				});
			});
		});
		$scope.selectedVendor = $scope.vendor[0]['vendorName'];
		//$scope.selectedVendor = $scope.vendor[0]['vendorName'];
		//console.log($scope.vendor);
		//console.log($scope.category);
		//console.log($scope.product);	
		//$scope.category = $scope.allProducts;
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
	
	 $scope.addToCart = function(object) {
	    if (typeof object.qty != 'undefined'){
			if(object.qty  != '' && object.price != ''){	
				$scope.addData = {vendor: object.vendor, category: object.category, id: parseInt(object.vid), title: object.title, price: parseFloat(object.price), qty: parseInt(object.qty), img: object.image, sum: parseFloat(object.sum)};
				cartService.addCart($scope.addData);
				$scope.validationError = "";
			 }else{
				$scope.validationError = "Please Enter Price and Quantity"; 
			 }
		}else{
			$scope.validationError = "Please Enter Price and Quantity";
		}
		
	 }
	 
	  /*$scope.cartTotalSum = function(){
		  cartService.cartTotalSum()
	  }
	 */
	 $scope.roundOfValue = function(a){ // a - row sum of price and qty
		  return cartService.roundOfValue(a);
	 }
}]);
