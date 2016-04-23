<?php 
	echo $this->Html->css('../js/angular/lib/css/jquery-ui.css');
	echo $this->Html->script('angular/lib/js/jquery.js'); 
	echo $this->Html->script('angular/lib/js/jquery-ui.custom.js'); 
	echo $this->Html->script('angular/lib/js/angular.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-route.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-resource.min.js');
	echo $this->Html->script('angular/lib/js/angular-cookies.min.js');
	echo $this->Html->script('angular/lib/js/angular-filter.min.js');
	echo $this->Html->script('angular/lib/js/angular-local-storage.js'); 
	echo $this->Html->script('angular/lib/js/simplePagination.js');
	echo $this->Html->script('angular/lib/js/ui-bootstrap-tpls.min.js'); 
	echo $this->Html->script('angular/lib/js/date.js'); 

	//echo $this->Html->script('angular/lib/js/angular-aside.min.js');
	//echo $this->Html->script('angular/lib/js/angular-touch.min.js');
	//echo $this->Html->script('angular/lib/js/services/authentication.service.js'); 
	//echo $this->Html->script('angular/lib/js/services/flash.service.js');
	//echo $this->Html->script('angular/lib/js/services/user.service.js');
?>
<div ng-app="shopping">
    <div class="content-wrapper" ng-view>
       
    </div>
</div>
<?php 
	echo $this->Html->script('angular/app.js'); 
	echo $this->Html->script('angular/controller.js'); 
	echo $this->Html->script('angular/editcontroller.js'); 
	echo $this->Html->script('angular/sales_controller.js');
	echo $this->Html->script('angular/sales_service.js');
	echo $this->Html->script('angular/filter.js'); 
?>