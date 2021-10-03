<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

<body ng-app="myApp">

    <p><a href="#/!">Main</a></p>

    <a href="#!red">Red</a>
    <a href="#!green">Green</a>
    <a href="#!blue">Blue</a>

    <div ng-view></div>

    <script>
        var app = angular.module("myApp", ["ngRoute"]);
        app.config(function($routeProvider) {
            $routeProvider
                .when("/", {
                    templateUrl: "main.php"
                })
                .when("/red", {
                    templateUrl: "red.php"
                })
                .when("/green", {
                    templateUrl: "green.htm"
                })
                .when("/blue", {
                    templateUrl: "blue.htm"
                });
        });
    </script>

    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Content</p>
                </div>
                <div class="modal-footer">
                    Footer nè
                </div>
            </div>
        </div>
    </div>
</body>

</html>