var app = angular.module('wn', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'views/home.html',
            controller: 'HomeCtrl'
        })
        .when('/projects', {
            templateUrl: 'views/projects.html',
            controller: 'ProjectsCtrl'
        })
        .when('/projects/:name', {
            templateUrl: 'views/home.html',
            controller: 'ProjectCtrl'
        })

        .when('/contact', {
            templateUrl: 'views/contact.html',
            controller: 'ContactCtrl'
        })
        .otherwise({
            redirectTo: '/'
        });
}]);
