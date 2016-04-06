//homeController 
shopping.controller("addPoController", ["$scope","$log","$timeout","$http",'$rootScope','$cookies','$filter', function ($scope, $log, $timeout, $http,$rootScope,$cookies,$filter) {
	
	$scope.cookieCartItems = $cookies.getObject('cart') || 0;
	$scope.allProducts = '{}';
	$scope.loader = true;
	
	$http({method: 'GET',url: '/orders/apiAddProducts.json',cache: false
	 }).success(function (data, status, headers, config) {
		 console.log('A');  
	    $scope.allProducts = data.products;
		console.log($scope.allProducts);
		$scope.vendor = [];
		$scope.category = [];
		$scope.product = [];
		angular.forEach($scope.allProducts, function(category, vendorkey) {
			$scope.vendor.push({'vendorName':vendorkey});
			angular.forEach(category, function(productObj, categoryKey) {
				$scope.category.push({'categoryName':categoryKey,'vendorName':vendorkey});
				angular.forEach(productObj.Product, function(prod, key) {
					$scope.product.push(prod);
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
	
	
	 $scope.filteredItemsLen = function() {
        return ($scope.filteredItems || []).length;  
     };
	
	 $scope.productLength = 4;
	 
	/* $scope.$watch('filteredItemsLen()', function(newValue, oldValue){
        console.log('Filtered length changed from ' +
                    oldValue + ' to ' + newValue);
    });*/
	
	 $scope.selectedCategory = [];

 	 $scope.categoryFilterExpression = function(categoryList) {
        return (categoryList.vendorName === $scope.selectedVendor );
     };
	 
	 $scope.productFilterExpression = function(productList) {
        return (productList.vendor === $scope.selectedVendor);
     };
	 
	 
	 $scope.checkCategory = function(cat) {
        var i = $.inArray(cat, $scope.selectedCategory);
        if (i > -1) {
            $scope.selectedCategory.splice(i, 1);
        } else {
            $scope.selectedCategory.push(cat);
        }
    }
	
	$scope.$watch('selectedVendor', function(newValue, oldValue) {
		$scope.selectedCategory = [];
	});
	
	$scope.categoryProductFilterExpression = function(productList) {
		
        if ($scope.selectedCategory.length > 0) {
            if ($.inArray(productList.category, $scope.selectedCategory) < 0)
                return;
        }
        
        return productList;
    }
	$scope.currentPage = 0;
    $scope.pageSize = 2;
    $scope.numberOfPages=function(){
        return Math.ceil($scope.filteredItemsLen()/$scope.pageSize);                
    }

}]);