yiiDB_site.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/site/index', {
                templateUrl: 'views/site/index.html',
                controller: 'index'
            })
            .when('/site/migration', {
                templateUrl: 'views/site/migration.html',
                controller: 'migration'
            })
            .otherwise({
                redirectTo: '/site/index'
            });
    }])
    .controller('migration', ['$scope', '$http', function ($scope, $http) {
        $scope.test = 'hello';

        $http.get('/migration/all')
            .success(function (data) {
                $scope.migrations = data;
            })

        $scope.applyMigration = function(name){
            $http.get('/migration/apply?name=' + name)
                .success(function (data) {
                    window.location.href = '/';
                })
                .error(function (err) {
                    alert('Не удалось провести миграцию');
                })
        }
    }])
