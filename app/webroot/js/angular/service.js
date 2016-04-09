shopping.service('cartService',['$routeParams','$http','$cookies','$filter','$rootScope','$log',function($routeParams, $http,$cookies,$filter,$rootScope,$log){
	var self = this;
	this.cartItem = {};
	this.cartItem.items = [];
	this.errorMessage = "";
	this.vendorName = "";
	this.cartDisable = true;
	
	this.expiresTime = function(){
		var now = new Date();
    	//now.setDate(now.getDate() + 7);	
		now.setDate(now.getDate());	
		now.setMinutes(now.getMinutes() + 05);
		$log.debug("fun: expiresTime - "+ now);
		return now;
	};

	this.addCart = function(singleObj){
		console.log(singleObj);
		var data = self.checkData(singleObj.id);
		if(data){
		  self.errorMessage;
	  	  self.cartItem.items.push(singleObj);
		  self.cartTotalQty('addCart');
		}else{
		  self.updateMoreQty(singleObj,singleObj.id);	
		  self.errorMessage = "Product already available in the cart";
		  $log.debug('fun: addCart - Product already available in the cart')
		}
	}	
	
	this.checkData = function(checkId){
		var found = $filter('getById')(self.cartItem.items, checkId);
		console.log(found);
		if(found === null){
		  console.log('available');
		  return true;	
		}else {
		  console.log('Not available');
		  return false;
		}
	}
	
	this.cartTotalQty = function(page){
		var totalQty = 0;
		for(var i=0; i<self.cartItem.items.length; i++){
			var items = self.cartItem.items[i];
			totalQty += parseInt(items.qty);
		}
		$log.debug("cartTotalQty: "+totalQty+ " Fucntion Name :"+page);
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		return totalQty;
	}

	this.updateMoreQty = function(input,id) {
		   var cartItems = self.cartItem.items;
		   var foundItem = $filter('filter')(cartItems, { id: id  }, true)[0];
		   var arrayIndex = cartItems.indexOf(foundItem)
		   if(foundItem.id === id){
			   console.log('Hello'+input.qty);
			   self.cartItem.items[arrayIndex].qty = parseInt(input.qty);
			   self.cartItem.items[arrayIndex].price = parseFloat(input.price);
			   self.cartItem.items[arrayIndex].sum = parseFloat(input.sum);
			   //console.log(self.cartItem.items);
			   $cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
			   self.cartTotalQty('updateMoreQty');
		   }else{
			    console.log('fuck');
		   }
			 
	 }
	 
	 this.addMoreQty = function(input,index) {
		//if(input.qty >= 1){
			console.log(Object.keys(input));
			console.log(parseInt(input.qty)+1);
			self.cartItem.items[index].qty = parseInt(input.qty)+1;
			$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
			console.log(input);
		//}
	 }
	 
	 this.removeMoreQty = function(input,index) {
		 if(input.qty > 1){
			self.cartItem.items[index].qty = parseInt(input.qty) - 1;
			$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		 }
	 }

	this.updateCart = function(qty,sum){
		self.cartItem["qtyTotal"] = qty;
		self.cartItem["sumTotal"] = sum;
		console.log('a');
		console.log(self.cartTotalQty())
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		console.log(self.cartItem);
	}
	
	this.removeCart = function(removeId){
		self.cartItem.items.splice(removeId, 1);
		self.cartTotalQty();
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		console.log("remove Cart:"+ self.cartItem.items.length)
		if(self.cartItem.items.length == 0){
		$cookies.putObject('vendor', '',{ expires:'Thu, 01 Jan 1970 00:00:00 UTC' });
		}
		$log.debug("fun: removeCart - "+ self.cartItem);
	}
	 
	
	this.cartTotalSum = function(){
		var totalSum = 0;
		for(var i=0; i<self.cartItem.items.length; i++){
			var items = self.cartItem.items[i];
			totalSum += parseInt(items.qty) * parseFloat(items.price).toFixed(2);
			console.log(typeof totalSum);
			if(typeof totalSum !== 'number'){
				  self.errorMessage = "invalid Sum";
				 return 0;
			}
		}
		return parseFloat(self.roundOfValue(totalSum)).toFixed(2);
	}
	
 	this.roundOfValue = function(value){
	 if(isNaN(value)){
		return 0;
	 }
	 return Math.round(value * 100) / 100;	
	}
	
	
	this.getCartItems = function(){
		if($cookies.getObject('cart')){
		   self.cartItem.items = $cookies.getObject('cart').items;
		   return self.cartItem;
		}
	}
	
	this.unSetCartItems = function(){
		$cookies.putObject('cart', '',{ expires:'Thu, 01 Jan 1970 00:00:00 UTC' });
		$cookies.putObject('vendor', '',{ expires:'Thu, 01 Jan 1970 00:00:00 UTC' });
	}
	
	this.checkCookieBeforeAdd = function(){
		if($cookies.getObject('cart')){
		   self.cartItem.items = $cookies.getObject('cart').items;
		   return self.cartItem.items;
		}else{
		   return 0;
		}
	}
	
	this.getVendorName = function(){
		if($cookies.getObject('vendor')){
		   self.vendorName = $cookies.getObject('vendor');
		   return self.vendorName;
		}else{
		   return false;
		}
	}
	
	this.setVendorName = function(vendorName){
		    $cookies.putObject('vendor', vendorName,{ expires:self.expiresTime() });
	}

}]);