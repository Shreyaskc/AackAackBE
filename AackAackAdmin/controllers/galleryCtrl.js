app.controller('galleryCtrl',["$scope","$http","$cookies","$cookieStore","$location",function($scope,$http,$cookies,$cookieStore,$location)
{
    
         if(($cookieStore.get('username')=="" || $cookieStore.get('username')==undefined) && ($cookieStore.get('pic')=="" || $cookieStore.get('pic')==undefined) && ($cookieStore.get('userid')=="" || $cookieStore.get('userid')==undefined))
         {
            $scope.message="";
           // window.location.href="#";
		   $location.path('/');
            
         }
        else
        {
		$scope.gridshow="true";
//        var url="http://www.myappdemo.net/aackaack_production/index.php/admin/nggetaacks/"+$cookieStore.get('userid');
		var url="http://35.163.222.1/AackAack/index.php/admin/nggetaacks/"+$cookieStore.get('userid');
		$http.get(url).success(function (data, status, headers, config)
            {
            $scope.profilepic=$cookieStore.get('pic');
            $scope.myname=$cookieStore.get('username');
			if(data.message=="Sorry! No Aacks to Display!")
			{
			$scope.gridshow="false";
			}
			else
			{
            $scope.img=data;
			}
            
            })
             .error(function (data, status, headers, config)
                   {
               alert(JSON.stringify(config));
           });
            
          $scope.mail=function(aackid)
          {
             // alert("hello");
             // window.location.href="#email/"+aackid;
              $location.path('/email/'+aackid);
			  
          }
        
        
        }
    
}]);