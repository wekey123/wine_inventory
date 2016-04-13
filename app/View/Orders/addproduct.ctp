<?php 
	echo $this->Html->script('angular/lib/js/angular.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-route.min.js'); 
	echo $this->Html->script('angular/lib/js/angular-resource.min.js');
	echo $this->Html->script('angular/lib/js/angular-cookies.min.js');
	echo $this->Html->script('angular/lib/js/angular-filter.min.js');
	echo $this->Html->script('angular/lib/js/simplePagination.js');
	echo $this->Html->script('angular/lib/js/ui-bootstrap-tpls.min.js'); 
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
	echo $this->Html->script('angular/service.js');
	echo $this->Html->script('angular/filter.js'); 
	//echo $this->Html->script('angular/directives.js'); 
	
	//echo $this->Html->script('angular/script.js'); 
?>