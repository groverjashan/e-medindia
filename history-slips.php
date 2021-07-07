<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        $module = angular.module("mymodule", []);
        $module.controller("mycontroller", function($scope, $http, $filter) {
            $scope.jsonArray;
            $scope.fetchAll = function() {
                var dfrom = $filter('date')($scope.dfrom, "yyyy-MM-dd");
                var dto = $filter('date')($scope.dto, "yyyy-MM-dd");
                $http.get("angular-fetch-slips.php?uid=" + $scope.uid + "&dfrom=" + dfrom + "&dto=" + dto).then(Ok, notOk);

                function Ok(response) {
                    $scope.jsonArray = response.data;
                }

                function notOk(response) {
                    alert(response.data);
                }
            }
        })

    </script>
    <style>
        th {
            cursor: pointer;
        }
        th:hover{
            background-color: antiquewhite;
        }

    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller" id="bg">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <div style="font-size:24px;">
            <img src="pics/slipr.png" width="80" height="80" alt="">
                SLIPS HISTORY
        </div>
    </nav>
    <br>

    <center>

        <br>
        <br>
        USER ID:-
        <input type="text" placeholder="User ID" ng-model="uid"  ng-init="uid='<?php echo $_SESSION["activeuser"]; ?>'" value='<?php echo $_SESSION["activeuser"]; ?>' readonly>
        <br>
        <br>
        FROM DATE:- <input type="date" class="ml-1 mr-5" ng-model="dfrom">
        TO DATE:- <input type="date" class="ml-1 mr-5" ng-model="dto">
        <div class="btn btn-info ml-5" style="width:200px;" ng-click="fetchAll();">FETCH</div>


        <br>
        <br>
        <div class="container">
        <div class="row">
            <div class="col-md-3 mt-3" ng-repeat="obj in jsonArray">

                <div class="card">
                    <img src="uploads/{{obj.slippic}}" height="100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">DOCTOR: {{obj.doctorname}}</h5>
                        <p class="card-text"> HOSPITAL: {{obj.hospital}}</p>
                        <p class="card-text"> DISCUSSION: {{obj.discussion}}</p>
                     </div>
                </div>
            </div>
        </div>
    </div>
    </center>
</body>

</html>
