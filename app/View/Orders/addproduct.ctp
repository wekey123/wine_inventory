<?php
	echo $this->Html->script('angular/lib/js/angular.min.js'); 
	echo $this->Html->script('angular/lib/js/ui-bootstrap-tpls.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-route.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-filter.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-resource.min.js');
	echo $this->Html->script('angular/lib/js/angular-cookies.min.js');
	echo $this->Html->script('angular/lib/js/simplePagination.js');
	echo $this->Html->script('angular/lib/js/angular-aside.min.js');
	echo $this->Html->script('angular/lib/js/angular-touch.min.js');
	echo $this->Html->script('angular/lib/js/services/authentication.service.js'); 
	echo $this->Html->script('angular/lib/js/services/flash.service.js');
	echo $this->Html->script('angular/lib/js/services/user.service.js');
?>
<div class="content-wrapper" ng-app="shopping">
   <div class="container" ng-controller="addPoController">
     <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Purchase Orders</h4>
        </div>
     </div>
 	<div class="row">	
 	 <div class="col-md-12">
     
        <div class="row">	
            <div class="col-md-6">
                 <div class="form-group">
                    <div class="col-md-3"><label><i class="fa fa-question-circle fa-fw"></i> Vendor List</label></div>
                    <div class="col-md-4">
                        <select class="form-control" ng-model="selectedVendor" >
                            <option value="">Select</option>
                            <option  ng-repeat="allVendor in vendor" value="{{allVendor.vendorName}}">{{allVendor.vendorName}}</option>
                        </select>
                    </div>
                 </div>
            </div>
        </div>
        
        <div class="row"  ng-show="selectedVendor!=''">  
          <div class="col-md-12">
                 <div class="form-group">
                    <div class="col-md-2"><label><i class="fa fa-question-circle fa-fw"></i>Category List</label></div><br/>
                       <!--  <pre>{{category | json}}</pre>-->
                   	 <div class="col-md-2">    
                          <label ng-repeat="allCategory in category | filter:categoryFilterExpression">{{allCategory.categoryName}}
							 <!--<input type="checkbox" ng-model="allCategory.categoryNamebox" ng-click="checkCategory(allCategory.categoryName)">-->
                           <input type="checkbox" ng-model="allCategory.categoryNamebox" ng-click="checkCategory(allCategory.categoryName)">
                          </label><br/>
                     </div>
                    </div>
                 </div>
            </div>
         </div>
	 </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Products List
            </div>
            <div class="panel-body"
            
                <div class="table-responsive" style="overflow-x:hidden;"><span class="error_msg_var"></span> 
                <!--{{ allProducts | json  }} </pre>-->
                    <table id="order_tab" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                          			 <tr ng-repeat="result in product | filter:productFilterExpression | filter:categoryProductFilterExpression | startFrom:currentPage*pageSize | limitTo:pageSize">
                                     <td>{{$index+1}}</td>
                                     <td>{{result.vendor}}</td>
                                     <td>{{result.category}}</td>
                                     <td>{{result.title}}</td>
                                     <td>{{result.price}}</td>
                                     <td>{{result.brand}}</td>
                                      <td>{{result.image}}</td>
                                    </tr>
                                    
                        </tbody>
                    </table>
                    <ul class="pager">
                      <li><a href="javascript:void(0)" ng-hide="currentPage == 0" ng-click="currentPage=currentPage-1">Previous</a></li>
                      <li> <span ng-cloak>{{currentPage+1}}/{{numberOfPages()}}</span></li>
                      <li><a href="javascript:void(0)" ng-hide="currentPage >= productLength/pageSize - 1" ng-click="currentPage=currentPage+1">Next</a></li>
                    </ul>
                    <pre>{{ productLength | json }}</pre>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
</div>
<?php 
	echo $this->Html->script('angular/app.js'); 
	echo $this->Html->script('angular/controller.js'); 
	//echo $this->Html->script('angular/service.js');
	//echo $this->Html->script('angular/directives.js'); 
	//echo $this->Html->script('angular/filter.js'); 
	//echo $this->Html->script('angular/script.js'); 
?>