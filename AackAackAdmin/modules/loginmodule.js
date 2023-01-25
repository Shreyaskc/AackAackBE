var app=angular.module('app',['ngRoute','ngCookies']);
    
    app.config(function($routeProvider){
        
        $routeProvider.when('/',
                            {
            controller:'loginCtrl',
            templateUrl:'views/loginview.html'
            
        })
        .when('/gallery',
                            {
            controller:'galleryCtrl',
            templateUrl:'views/galleryview.html'
            
        })
         .when('/email/:aackid',
                            {
            controller:'emailCtrl',
            templateUrl:'views/emailview.html'
            
        })
        .when('/logout',
                            {
            controller:'loginCtrl',
            templateUrl:'views/loginview.html'
            
        })
		.when('/report',
						{
			controller:'reportCtrl',
			templateUrl:'views/reportview.html'

		})
      .otherwise({redirectTo:'/'});
        
    });
