'use strict';
// ������ �� ��������� ����� ����������
var serviceBase = 'http://server.local';
// �������� ������ ���������� � ��� ����������
var yiiDB = angular.module('yiiDB', [
  'ngRoute',
  'yiiDB.site'
]);
// ������� ������
var yiiDB_site = angular.module('yiiDB.site', ['ngRoute']);
 
yiiDB.config(['$routeProvider', function($routeProvider) {
  // ������� ��-���������
  $routeProvider.otherwise({redirectTo: '/site/index'});
}]);