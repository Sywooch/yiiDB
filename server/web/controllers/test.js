// angular.module(, ['ngAnimate']).controller('test', function($scope) {
//     $scope.friends = [
//         {name:'John', age:25, gender:'boy'},
//         {name:'Jessie', age:30, gender:'girl'},
//         {name:'Johanna', age:28, gender:'girl'},
//         {name:'Joy', age:15, gender:'girl'},
//         {name:'Mary', age:28, gender:'girl'},
//         {name:'Peter', age:95, gender:'boy'},
//         {name:'Sebastian', age:50, gender:'boy'},
//         {name:'Erika', age:27, gender:'girl'},
//         {name:'Patrick', age:40, gender:'boy'},
//         {name:'Samantha', age:60, gender:'girl'}
//     ];
//     $scope.test = 123;
// });

yiiDB_site.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/site/index', {
                templateUrl: 'views/site/index.html',
                controller: 'index'
            })
            .when('/test', {
                templateUrl: 'views/test.html',
                controller: 'test'
            })
            .otherwise({
                redirectTo: '/site/index'
            });
    }])
    .controller('test', ['$scope', '$http', '$interval', 'uiGridConstants', function ($scope, $http, $interval, uiGridConstants) {
        $scope.friends = [
            {name:'John', age:25, gender:'boy'},
            {name:'Jessie', age:30, gender:'girl'},
            {name:'Johanna', age:28, gender:'girl'},
            {name:'Joy', age:15, gender:'girl'},
            {name:'Mary', age:28, gender:'girl'},
            {name:'Peter', age:95, gender:'boy'},
            {name:'Sebastian', age:50, gender:'boy'},
            {name:'Erika', age:27, gender:'girl'},
            {name:'Patrick', age:40, gender:'boy'},
            {name:'Samantha', age:60, gender:'girl'}
        ];
    }])
