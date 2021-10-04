<?php include 'inc/header.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
<script src="js/jquery/jquery-2.2.4.min.js"></script>

<body ng-app="myApp">
<div ng-view></div>

    <p><a href="app.html#/!">Main</a></p>

    <a href="app.html#!red">Red</a>
    <a href="#!green">Green</a>
    <a href="#!blue">Blue</a>

    <div ng-view></div>

    <script>
        var app = angular.module("myApp", ["ngRoute"]);
        app.config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: "home.html"
                })
                .when("/red", {
                    templateUrl: "red.html"
                })

        });
    </script>

    <p>Click on the links to navigate to "red.htm", "green.htm", "blue.htm", or back to "main.htm"</p>
</body>
<?php include 'inc/footer.php' ?>

</html>