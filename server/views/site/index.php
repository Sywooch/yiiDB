<!DOCTYPE html>
<html ng-app="yiiDB">
<head>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/angular-ui-grid/ui-grid.min.css">
    <link rel="stylesheet" href="styles/main.css"/>
</head>
<body ng-controller="index">
<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">YiiDB</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#/site/index">Главная</a></li>
                    <li><a href="#/site/migration">История миграций</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!-- Main component for a primary marketing message or call to action -->
    <div id="main">
        <!-- Здесь будет динамическое содержимое -->
        <div ng-view></div>
    </div>

</div> <!-- /container -->

<script src="assets/jquery/dist/jquery.min.js"></script>
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/angular/angular.min.js"></script>
<script src="assets/angular-route/angular-route.min.js"></script>
<script src="assets/angular-ui-grid/ui-grid.min.js"></script>
<script src="app2.js"></script>
<script src="controllers/site.js"></script>
<script src="controllers/migration.js"></script>
</body>
</html>