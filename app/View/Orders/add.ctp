<!DOCTYPE html>
<html>
<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd)	{
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
<?php echo $this->Html->script('angular.min.js'); ?>
<body>
<div ng-app="myApp" ng-controller="customersCtrl"> 

<table>
  <tr ng-repeat="x in names | startFrom:currentPage*pageSize | limitTo:pageSize">
    <td>{{ x.Product.id }}</td>
    <td>{{ x.Product.title }}</td>
  </tr>
</table>
<button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1">
        Previous
    </button>
    {{currentPage+1}}/{{numberOfPages()}}
    <button ng-disabled="currentPage >= names.length/pageSize - 1" ng-click="currentPage=currentPage+1">
        Next
    </button>
    
    
    <div>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-3"><label><i class="fa fa-question-circle fa-fw"></i> District List</label></div>
                <div class="col-md-4">
                    <select class="form-control" ng-model="selectedDist" ng-options="district.name for district in districts">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3"><label><i class="fa fa-question-circle fa-fw"></i> Thana List</label></div>
                <div class="col-md-4">
                    <select class="form-control" ng-model="selectedThana" ng-options="thana.name for thana in thanas | filter: filterExpression">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    
    
</div>

<script>
//http://www.w3schools.com/angular/customers.php
//http://192.168.1.105/products/lists
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $http.get("http://192.168.1.105/products/lists.json")
    .then(function (response) {console.log(response);$scope.names = response.data.varies;});
	 $scope.currentPage = 0;
     $scope.pageSize = 10;
     $scope.names = [];
	 $scope.numberOfPages=function(){
		return Math.ceil($scope.names.length/$scope.pageSize);                
	 }
	 
	 
	 $scope.selectedDist={};
            $scope.districts = [
                {id: 1, name: 'Dhaka'},
                {id: 2, name: 'Goplaganj'},
                {id: 3, name: 'Faridpur'}
            ];

            $scope.thanas = [
                {id: 1, name: 'Mirpur', dId: 1},
                {id: 2, name: 'Uttra', dId: 1},
                {id: 3, name: 'Shahabag', dId: 1},
                {id: 4, name: 'Kotalipara', dId: 2},
                {id: 5, name: 'Kashiani', dId: 2},
                {id: 6, name: 'Moksedpur', dId: 2},
                {id: 7, name: 'Vanga', dId: 3},
                {id: 8, name: 'faridpur', dId: 3}
            ];
            $scope.filterExpression = function(thana) {
                return (thana.dId === $scope.selectedDist.id );
            };
	 
	 
	 
	
});
app.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});

</script>

</body>
</html>
