shopping.service('cartService',['$routeParams','$http','$cookies','$filter','$rootScope','$log',function($routeParams, $http,$cookies,$filter,$rootScope,$log){
	var self = this;
	this.cartItem = {};
	this.cartItem.items = [];
	this.errorMessage = "";
	//this.cartCount = $rootScope.cartCount();
	//this.getTotalQty = $rootScope.getTotalQty();
	this.cartDisable = true;
	
	this.expiresTime = function(){
		var now = new Date();
    	now.setDate(now.getDate() + 7);	
		$log.debug("fun: expiresTime - "+ now);
		return now;
	};

	this.addCart = function(singleObj){
		self.addData = {id: singleObj.id, title:singleObj.title, price:singleObj.price, qty:singleObj.qty, img:singleObj.img};
		var data = self.checkData(singleObj.id);
		if(data){
		  self.errorMessage;
	  	  self.cartItem.items.push(self.addData);
		  self.cartTotalQty();
		  $cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		  $log.debug("fun: addCart - ");
		  console.log(self.cartItem.items);
		}else{
		  self.updateMoreQty(self.cartItem.items,singleObj.id);	
		  self.errorMessage = "Product already available in the cart";
		  $log.debug('fun: addCart - Product already available in the cart')
		}
	}	

	this.updateMoreQty = function(input,id) {
		var i=0, len=input.length;
		for (; i<len; i++) {
		   if(input[i].id === id){
			   self.cartItem.items[i].qty = parseInt(input[i].qty) + 1;
			   $cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		   }
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
		//$rootScope.cartCount();
		console.log('a');
		console.log(self.cartTotalQty())
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		console.log(self.cartItem);
	}
	
	this.removeCart = function(removeId){
		self.cartItem.items.splice(removeId, 1);
		//$rootScope.cartCount();
		self.cartTotalQty();
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		$log.debug("fun: removeCart - "+ self.cartItem);
	}
	 
	this.checkData = function(checkId){
		var found = $filter('getById')(self.cartItem.items, checkId);
		if(found === null){
		  console.log('available');
		  return true;	
		}else {
		  console.log('Not available');
		  return false;
		}
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
	 return Math.round(value * 100) / 100;	
	}
	
	/*this.getTotalQty = function(){
		return $rootScope.getTotalQty();
	}*/
	
	this.cartTotalQty = function(){
		var totalQty = 0;
		for(var i=0; i<self.cartItem.items.length; i++){
			var items = self.cartItem.items[i];
			totalQty += parseInt(items.qty);
		}
		$cookies.putObject('cart', self.cartItem,{ expires:self.expiresTime() });
		console.log(totalQty);
		return totalQty;
	}
	
	this.getCartItems = function(){
		if($cookies.getObject('cart')){
		   self.cartItem.items = $cookies.getObject('cart').items;
		   return self.cartItem;
		}
	}
	
	this.addCartItems = function(){
		if($cookies.getObject('cart')){
		   self.cartItem.items = $cookies.getObject('cart').items;
		   return self.cartItem.items;
		}
	}
	
}]);