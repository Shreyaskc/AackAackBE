app.controller('reportCtrl',["$scope","$http","$cookies","$cookieStore","$location",function($scope,$http,$cookies,$cookieStore,$location)
{
    
         if(($cookieStore.get('username')=="" || $cookieStore.get('username')==undefined) && ($cookieStore.get('pic')=="" || $cookieStore.get('pic')==undefined) && ($cookieStore.get('userid')=="" || $cookieStore.get('userid')==undefined))
         {
            $scope.message="";
		    $location.path('/');
         }
        else
        {
		   $scope.profilepic=$cookieStore.get('pic');
           $scope.myname=$cookieStore.get('username');
//		   $http.get("http://www.myappdemo.net/aackaack_production/index.php/admin/getreports")
		   $http.get("http://35.163.222.1/AackAack/index.php/admin/getreports")
			.success(function (data, status, headers, config)
			{
			  //alert(JSON.stringify(data));
			  $scope.reports=data;
			});	

		$scope.delete=function(flag)
		{
		//1 means delete sql data//2 means delete s3 data
		 $scope.flag=flag;
		 if(flag==1)
         $scope.action="Delete All SQL Data";
		 else if(flag==2)
		 $scope.action="Delete All S3 Data";

		};	
		
		$scope.confirmdelete=function(flag)
		{
		//1 means delete sql data//2 means delete s3 data
		if(flag==1)
		{
//			$http.get("http://www.myappdemo.net/aackaack_production/index.php/admin/truncAllTables")
			$http.get("http://35.163.222.1/AackAack/index.php/admin/truncAllTables")
			.success(function (data, status, headers, config)
			{
			
//				$http.get("http://www.myappdemo.net/aackaack_production/index.php/admin/getreports")
				$http.get("http://35.163.222.1/AackAack/index.php/admin/getreports")
				.success(function (data, status, headers, config)
				{
				//alert(JSON.stringify(data));
				$scope.reports=data;
				});	

			});	
		}
		else if(flag==2)
		{
		
//		    $http.get("http://www.myappdemo.net/aackaack_production/index.php/admin/deleteS3Data")
		    $http.get("http://35.163.222.1/AackAack/index.php/admin/deleteS3Data")
			.success(function (data, status, headers, config)
			{
			  //alert(JSON.stringify(data));
			  $scope.reports=data;
			});	
		
		
		}
		
		};
		
        }
    
}]);