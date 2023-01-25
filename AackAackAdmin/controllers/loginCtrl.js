app.controller('loginCtrl',["$scope","$http","$cookies","$cookieStore","$location",function($scope,$http,$cookies,$cookieStore,$location)
{
//alert($scope.username);
   //$scope.user = {};
        $cookieStore.put("userid",'');
        $cookieStore.put("pic",'');
        $cookieStore.put("username",'');
    
    $scope.Login=function()
    {
        // alert($scope.user.username);
        // alert($scope.user.password);
        if(($scope.user.username== "" || $scope.user.username==undefined) && ($scope.user.password== ""  || $scope.user.password==undefined))
          $scope.user.message="Username and Password cannot be empty";
        else if(($scope.user.username== "" || $scope.user.username==undefined))
          $scope.user.message="Username cannot be empty";
        else if(($scope.user.password== ""  || $scope.user.password==undefined))
          $scope.user.message="Password field required";
        else
        { 
           /*var details={'username':$scope.user.username,'password':$scope.user.password};
           alert(JSON.stringify(details));
           $http({
                method: 'POST',
                //url: "http://localhost:3001/admin/publishgame?format=json",
                url: "http://www.myappdemo.net/aackaack/index.php/admin/angularlogin",
                data: details
            }).success(function (data, status, headers, config) {
                alert(JSON.stringify(data));
            })
            .error(function (data, status, headers, config)
                   {
               alert(JSON.stringify(config));
           });   */
            var url='http://35.163.222.1/AackAack/index.php/admin/angularlogin/'+$scope.user.username+'/'+$scope.user.password;
           // alert(url);
        $http.get(url).success(function (data, status, headers, config)
            {
            
            if(data.message=="fail")
            $scope.user.message="user not found";
            else if(data.message=="success")
            {
                
                $cookieStore.put("userid", data.userid);
                $cookieStore.put("pic", data.pic);
                $cookieStore.put("username", data.username);
                
            //  alert($cookieStore.get('username'));
            //  alert($cookieStore.get('pic'));
            //  alert($cookieStore.get('userid'));
              
            // window.location.href = "#gallery";
			 $location.path('/gallery');
                
           }
        
            }).
            error(function (data, status, headers, config)
                   {
               alert(JSON.stringify(config));
           });
            
        }
        
      
     //$scope.user.message="user not found";
        
        
    }


}])