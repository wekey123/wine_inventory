
shopping.controller("salesAddController", ["$scope","$log","$timeout","$http",'$rootScope','$cookies','$filter','salesService','$routeParams','$location','localStorageService', function ($scope, $log, $timeout, $http,$rootScope,$cookies,$filter,salesService,$routeParams,$location,localStorageService) {console.log('Function: addPoController');

	if(localStorageService.get('sales')){
		$scope.cookieCartItems =  salesService.getCartItems().items;
	}
	$scope.addCart = true;
	$scope.editCart = false;
	$scope.allProducts = '{}';
	$scope.loader = true;
	$scope.validationError = '';
	$scope.showProduct = false;
	$scope.url = $rootScope.filePath.location+'sales/apiAddProducts.json';
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
					$scope.prod.cr_qty = 0;
					$scope.prod.mfg_qty = 0;
					console.log($scope.cookieCartItems);
					 if($scope.cookieCartItems){
						var i=0, len=$scope.cookieCartItems.length;
						for (; i<len; i++) {
						   if(parseInt($scope.cookieCartItems[i].id) === parseInt($scope.prod.pv_id)){
							  $scope.prod.cr_qty = parseInt($scope.cookieCartItems[i].cr_qty);
							  $scope.prod.mfg_qty = parseInt($scope.cookieCartItems[i].mfg_qty);
							  $scope.prod.sold_qty = parseInt($scope.cookieCartItems[i].sold_qty);
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
		/*console.log($scope.vendor);
		console.log($scope.category);
		console.log($scope.product);	*/
		return false;
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
		console.log(object);
	    if (typeof object.invoice_qty != 'undefined'){
			if(object.invoice_qty  != '' && object.price != ''){	
			
				$scope.addData = {
				vendor_id: parseInt(object.vendor_id),
				category_id: parseInt(object.vendor_type),
				vendor: object.vendor,
				category: object.category, 
				id: parseInt(object.pv_id), 
				p_id: parseInt(object.id), 
				title: object.title, 
				size: object.variant, 
				metric: object.metric, 
				qty_type: object.qty_type, 
				qty: object.qty, 
				price: parseFloat(object.price), 
				invoice_qty: parseInt(object.invoice_qty),  
				sold_qty: parseInt(object.sold_qty), 
				cr_qty: parseInt(object.cr_qty), 
				mfg_qty: parseInt(object.mfg_qty), 
				img: object.image, 
				sum: parseFloat(object.sum)
				};
				
				
				console.log($scope.addData);
				salesService.addCart($scope.addData);
				$scope.validationError = "";
			 }else{
				$scope.validationError = "Please Enter Price and Quantity"; 
			 }
		}else{
			$scope.validationError = "Please Enter Price and Quantity";
		}
		
	 }
	 
	 $scope.getTotalSum = function(){
			 return salesService.cartTotalSum('salesController');
	 }
	
	 $scope.getTotalQty = function(){
			return salesService.cartTotalQty('salesController');
	 }
	 

	 $scope.roundOfValue = function(a){ // a - row sum of price and quantity
		 	return salesService.roundOfValue(a);
	 }

	 $scope.submitSales = function(){
			var txt;
			var r = confirm("Would you like to Post Sales Order ?");
			if (r == true) {	
				console.log('OK Success');
				$scope.url = $rootScope.filePath.location+'sales/addSales.json';
				 $scope.inputData= { items: $scope.cookieCartItems, cartQty: $scope.getTotalQty(),cartSum: $scope.getTotalSum()};
				$http({method: 'POST',url: $scope.url,data :$scope.inputData,cache: false}).success(function (data, status, headers, config) {
					console.log(data);
					 if(data.responseCart.response !== 'E'){
						 console.log(data.responseCart);
						 localStorageService.clearAll('sales');
					 }
				}).error(function (data, status, headers, config) {
					 console.log(data.responseSale);
				}); 		
				return false;
			} else {
				console.log('You pressed Cancel!');
				return false;
			}
			
	 }
	 
}]);