
var parserApp = angular.module('parserApp', []);


parserApp.controller('ParserCtrl', function ParserCtrl($scope, $http) {
 /* $scope.sortType = 'id';
  $scope.sortReverse = false;
  $scope.searchUser = '';
  $scope.writeUsersWindow = false;
  $scope.addUserWindow = false;

  $scope.sortUsers = function (name){
    $scope.sortType = name;
  };

  $scope.reverseUsers = function(){
    $scope.sortReverse = !$scope.sortReverse;
  };

  $scope.writeUser = function (user){
    $scope.writeUsersWindow = user;
  };

  $scope.closeWriteUser = function (){
    $scope.writeUsersWindow = false;
  };
  $scope.addUser = function(){
    $(window).scrollTop(0);
    $scope.addUserWindow = !$scope.addUserWindow;
  };*/
/*  $scope.sendNewUser = function(){
    var formAddUser = document.adduser;
    var data = { 'first_name' : formAddUser.first_name,
                 'last_name' : formAddUser.last_name,
                 'email' : formAddUser.email
               };
    var formAddUser.firstname = formAddUser.first_name;
    var lasttname = formAddUser.last_name;
    var email = formAddUser.email;
    console.log(data);
   // $http.post('addUser.php', data)
    //$scope.getUsers();
  };*/
  $scope.getInventory = function(){
    $http.get('http://parser/parser.php')
    .then(function(response){
      $scope.userinventory = response.data;
    });
  };
  $scope.getInventory();
});