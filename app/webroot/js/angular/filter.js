
/*shopping.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});*/


shopping.filter('getById', function() {
  return function(input, id) {
    var i=0, len=input.length;
    for (; i<len; i++) {
      if (+input[i].id == +id) {
        return input[i];
      }
    }
    return null;
  }
});

shopping.filter('sortByDetails',function($filter){
    return function(items,value){
			 var filtered = [];
			 if(typeof value === 'undefined' ||  value == ''){
				 return items;
			 }
			 for (var i=0; i<items.length; i++) {
				 items[i].Product.price = Number(items[i].Product.price);
			 }
		 return $filter('orderBy')(items,value,false);
    }
});