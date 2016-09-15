yiiDB_site.config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/site/index', {
                templateUrl: 'views/site/index.html',
                controller: 'index'
            })
            .otherwise({
                redirectTo: '/site/index'
            });
    }])
    .controller('index', ['$scope', '$http', '$interval', 'uiGridConstants', function ($scope, $http, $interval, uiGridConstants) {
        $scope.selectedTable = null;

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

        getTables();
    }])
