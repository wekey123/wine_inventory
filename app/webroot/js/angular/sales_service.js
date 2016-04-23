shopping.service('salesService',['$routeParams','$http','localStorageService','$filter','$rootScope','$log',function($routeParams, $http,localStorageService,$filter,$rootScope,$log){
	
	var self = this;
	this.salesItem = {};
	this.salesItem.items = [];

	this.getCartItems = function(keyname){
		if(localStorageService.get(keyname)){
		   self.salesItem = localStorageService.get(keyname);
		   return self.salesItem;
		}
	}
	
	this.clearAll = function(keyname){
		self.salesItem.items = [];
		localStorageService.set(keyname, self.salesItem);
		return localStorageService.clearAll();
	}
	
	this.addCart = function(singleObj,keyname){
		console.log(singleObj); //return false;
		var data = self.checkData(singleObj.id);
		if(data){
	  	  self.salesItem.items.push(singleObj);
		  self.cartTotalQty('addCart',keyname);
		}else{
		  self.updateMoreQty(singleObj,singleObj.id,keyname);	
		  $log.debug('Fucntion Name : addCart - Product already available in the cart');
		  //return false;
		}
	}	
	
	this.checkData = function(checkId){
		var found = $filter('getById')(self.salesItem.items, checkId);
		console.log(found);
		if(found === null){
		  console.log('available');
		  return true;	
		}else {
		  console.log('Not available');
		  return false;
		}
	}
	
	this.updateMoreQty = function(input,id,keyname) {
		   var salesItem = self.salesItem.items;
		   var foundItem = $filter('filter')(salesItem, { id: id  }, true)[0];
		   var arrayIndex = salesItem.indexOf(foundItem)
		   if(foundItem.id === id){
			   self.salesItem.items[arrayIndex].sold_qty = parseInt(input.sold_qty);
			   self.salesItem.items[arrayIndex].price = parseFloat(input.price);
			   self.salesItem.items[arrayIndex].sum = parseFloat(input.sum);
			   self.salesItem.items[arrayIndex].cr_qty = parseInt(input.cr_qty);
			   self.salesItem.items[arrayIndex].mfg_qty = parseInt(input.mfg_qty);
			   localStorageService.set(keyname, self.salesItem);
			   self.cartTotalQty('updateMoreQty');
		   }else{
			    console.log('luck');
		   }
			 
	 }
	 
	this.cartTotalQty = function(page,keyname){
		if(self.salesItem.items.length >0){
			var totalQty = 0;
			for(var i=0; i<self.salesItem.items.length; i++){
				var items = self.salesItem.items[i];
				totalQty += parseInt(items.sold_qty);
			}
			$log.debug("cartTotalQty: "+totalQty+ " Fucntion Name :"+page);
			localStorageService.set(keyname, self.salesItem);
			return totalQty;
		}else{
			return 0;
		}
	}
	
	this.cartTotalSum = function(page,keyname){
		if(self.salesItem.items.length >0){
			var totalSum = 0;
			for(var i=0; i<self.salesItem.items.length; i++){
				var items = self.salesItem.items[i];
				totalSum += parseInt(items.sold_qty) * parseFloat(items.price).toFixed(2);
				$log.debug("cartTotalSum: "+totalSum+ " Fucntion Name :"+page);
				if(typeof totalSum !== 'number'){
					  self.errorMessage = "invalid Sum";
					 return 0;
				}
			}
			return parseFloat(self.roundOfValue(totalSum)).toFixed(2);
		}else{
			return parseFloat(0).toFixed(2);
		}
	}

	
 	this.roundOfValue = function(value){
	 if(isNaN(value)){
		return 0;
	 }
	 return Math.round(value * 100) / 100;	
	}

}]);