var parserApp = angular.module('parserApp', []);

parserApp.controller('ParserCtrl', function ParserCtrl($scope, $http) {
  $scope.getInventory = function(){
    $http.get('parser.php')
    .then(function(response){
      $scope.userinventory = response.data;
    });
  };
  $scope.getInventory();
});