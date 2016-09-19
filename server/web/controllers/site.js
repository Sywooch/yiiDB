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
    .controller('index', ['$scope', '$http', '$interval', 'uiGridConstants', function ($scope, $http, $interval, uiGridConstants) {
        $scope.selectedTable = null;
        $scope.fields = [];
        $scope.gridOptions = {
            enableFiltering: true,
            columnDefs: [
                // default
                {
                    name: 'table', displayName: 'Список таблиц',
                    filter: {
                        placeholder: 'Поиск'
                    }
                },
            ],
            enableRowSelection: true,
            enableRowHeaderSelection: false
        };

        $scope.gridOptions.multiSelect = false;
        $scope.gridOptions.modifierKeysToMultiSelect = false;
        $scope.gridOptions.noUnselect = true;
        $scope.gridOptions.onRegisterApi = function( gridApi ) {
            $scope.gridApi = gridApi;

            gridApi.selection.on.rowSelectionChanged($scope,function(row){
                //var msg = 'row selected ' + row;
                $scope.selectedTable = row.entity.table;
                setTable(row.entity.table);
            });
        };

        $scope.addTable = function() {
            var name = prompt('Название новой таблицы');
            if(name){
                $http.get('/tables/create/?name=' + name)
                    .success(function () {
                        getTables();
                    })
                    .error(function(){
                        alert('Ошибка при создании таблицы ');
                    })
            }
        };

        $scope.removeTable = function() {
            if ($scope.selectedTable) {
                if(confirm('Вы уверены, что хотите удалить таблицу: ' + $scope.selectedTable + '?')) {
                    $http.get('/tables/drop/?name=' + $scope.selectedTable)
                        .success(function () {
                            getTables();
                        })
                        .error(function () {
                            alert('Ошибка при удалении таблицы ');
                        })
                }
            } else {
                alert('Вы ничего не выбрали');
            }
        };

        function getTables(){
            $http.get('/tables/all')
                .success(function(data) {
                    console.log(data);
                    $scope.gridOptions.data = data;
                    // console.log($scope);
                    // $interval( function() {$scope.gridApi.selection.selectRow($scope.gridOptions.data[0]);}, 0, 1);
                })
                .error(function(){
                    alert('Ошибка при загрузке списка таблиц')
                })
        }

        function setTable(name){
            $http.get('/fields/get/?table=' + name)
                .success(function(data) {
                    console.log(data);
                    $scope.fields = data;
                    // console.log($scope);
                    // $interval( function() {$scope.gridApi.selection.selectRow($scope.gridOptions.data[0]);}, 0, 1);
                })
                .error(function(){
                    alert('Ошибка при загрузке списка полей таблицы ' + name);
                })
        }

        $scope.addField = function(){
            $scope.fields.push({
                Field:  $scope.field.Name,
                Type:   $scope.field.Type,
                Length: $scope.field.Length,
            })
            $scope.field = null;
        };

        $scope.delField = function(index){
            $scope.fields.splice(index, 1);
        }

        $scope.migrate = function(){
            $http.get('/fields/migrate/?table='+$scope.selectedTable+'&data=' + encodeURIComponent(JSON.stringify($scope.fields)))
                .success(function(data) {
                    console.log(data);
                })
        }
        getTables();
    }])
