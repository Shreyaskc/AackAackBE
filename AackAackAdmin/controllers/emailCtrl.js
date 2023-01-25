app.controller('emailCtrl',["$scope","$http","$cookies","$cookieStore","$routeParams","$location",function($scope,$http,$cookies,$cookieStore,$routeParams,$location)
{
    
         if(($cookieStore.get('username')=="" || $cookieStore.get('username')==undefined) && ($cookieStore.get('pic')=="" || $cookieStore.get('pic')==undefined) && ($cookieStore.get('userid')=="" || $cookieStore.get('userid')==undefined))
         {
            $scope.message="";
           // window.location.href="#";
			$location.path('/');
            
         }
        else
        {
           
        //var url="http://www.myappdemo.net/aackaack_production/index.php/admin/aackemail/"+$cookieStore.get('userid')+"/"+$routeParams.aackid;
        	var url="http://35.163.222.1/AackAack/index.php/admin/aackemail/"+$cookieStore.get('userid')+"/"+$routeParams.aackid;
        $http.get(url).success(function (data, status, headers, config)
            {
            $scope.profilepic=$cookieStore.get('pic');
            $scope.myname=$cookieStore.get('username');
            $scope.img=data;
            //alert(JSON.stringify(data));
            //alert($scope.img);
            
            })
             .error(function (data, status, headers, config)
                   {
               alert(JSON.stringify(config));
           });
        
        
        }
    
    $scope.sendmail=function()
    {
        //alert("hello");
        if($scope.user.email == "" || $scope.user.email == undefined)
        $scope.validate="Email field required"
        else
        {
           
//      var url="http://www.myappdemo.net/aackaack_production/index.php/admin/sendemail/"+$cookieStore.get('userid')+"/"+$routeParams.aackid+"/"+$scope.user.email;
        	  var url="http://35.163.222.1/AackAack/index.php/admin/sendemail/"+$cookieStore.get('userid')+"/"+$routeParams.aackid+"/"+$scope.user.email;
           $http.get(url).success(function (data, status, headers, config)
            {
             $scope.validate= data.message;
            
            
            })
            .error(function (data, status, headers, config)
                   {
               alert(JSON.stringify(config));
           });   
            
            
        }   
    }
    
    $scope.back=function()
    {
        
        
       // window.location.href="#gallery";
		$location.path('/gallery');
        
    }
    
}]);