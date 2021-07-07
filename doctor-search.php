<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script>
        $module = angular.module("mymodule", []);
        $module.controller("mycontroller", function($scope, $http) {
            $scope.jsonArray;
            $scope.selObj;
            $scope.fetchCity = function() {
                $http.get("angular-fetch-city.php").then(Ok, notOk);

                function Ok(response) {
                    $scope.jsonArray = response.data;
                    $scope.selObj = $scope.jsonArray[1];
                }

                function notOk(response) {
                    alert(response.data);
                }
            }
            $scope.doShow = function() {
                //alert($scope.selObj.city);

                $http.get("angular-fetch-city-doctors.php?city=" + $scope.selObj.city).then(Ok, notOk);

                function Ok(response) {
                    //alert(JSON.stringify(response.data));
                    $scope.jsonArray2 = response.data;
                }

                function notOk(response) {
                    alert(response.data);
                }
            }
        })

    </script>
    <title>Document</title>
</head>

<body ng-app="mymodule" ng-controller="mycontroller" ng-init="fetchCity();">
    <center>
        Select City :-- <select ng-options="obj.city for obj in jsonArray" ng-model="selObj"></select>
        <br>
        <br>
        <div class="btn btn-dark" ng-click="doShow();">FETCH</div>
    </center>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-3" ng-repeat="obj in jsonArray2">

                <div class="card">
                    <img src="uploads/{{obj.ppic}}" height="100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">NAME:{{obj.dname}}</h5>
                        <p class="card-text">CONTACT: {{obj.contact}}</p>
                        <p class="card-text">HOSPITAL: {{obj.hospital}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
