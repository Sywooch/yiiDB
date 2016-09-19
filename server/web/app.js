'use strict';

// Основной модуль приложения и его компоненты
var yiiDB = angular.module('yiiDB', [
  'ngRoute',
  'yiiDB.site',
  'ui.grid',
  'ui.grid.selection',
  //'ngRepeat'
]);

// рабочий модуль
var yiiDB_site = angular.module('yiiDB.site', ['ngRoute']);

yiiDB.config(['$routeProvider', function($routeProvider) {
  // Маршрут по-умолчанию
  $routeProvider.otherwise({redirectTo: '/site/index'});
}]);