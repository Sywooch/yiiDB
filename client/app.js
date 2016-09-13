'use strict';
// Ссылка на серверную часть приложения
var serviceBase = 'http://server.local';
// Основной модуль приложения и его компоненты
var yiiDB = angular.module('yiiDB', [
  'ngRoute',
  'yiiDB.site'
]);
// рабочий модуль
var yiiDB_site = angular.module('yiiDB.site', ['ngRoute']);
 
yiiDB.config(['$routeProvider', function($routeProvider) {
  // Маршрут по-умолчанию
  $routeProvider.otherwise({redirectTo: '/site/index'});
}]);