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
                $http.get("angular-fetch-sugar.php?uid=" + $scope.uid + "&dfrom=" + dfrom + "&dto=" + dto).then(Ok, notOk);

                function Ok(response) {
                    $scope.jsonArray = response.data;
                }

                function notOk(response) {
                    alert(response.data);
                }
            }
            $scope.doSort = function(cname) {
                $scope.col = cname;
            }
        })

        $(document).ready(function(){
           $("#konsi").change(function() {
                    if($(this).prop("selectedIndex")==1)
                        {
                            document.getElementById("table1").style.display="contents";
                            document.getElementById("table2").style.display="none";
                            document.getElementById("table3").style.display="none";
                        }
                    if($(this).prop("selectedIndex")==2)
                        {
                            document.getElementById("table1").style.display="none";
                            document.getElementById("table2").style.display="contents";
                            document.getElementById("table3").style.display="none";
                        }
                    if($(this).prop("selectedIndex")==3)
                        {
                            document.getElementById("table1").style.display="none";
                            document.getElementById("table2").style.display="none";
                            document.getElementById("table3").style.display="contents";
                        }
            })
        });
        
    </script>
    <style>
        th {
            cursor: pointer;
        }
        th:hover{
            background-color: antiquewhite;
        }
        table{
            /*visibility:collapse;\*/
            display: none;
        }
    </style>
</head>

<body ng-app="mymodule" ng-controller="mycontroller" id="bg">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <div style="font-size:24px;">
            <img src="pics/hists.png" width="80" height="80" alt="">
            SUGAR HISTORY
        </div>
    </nav>
    <br>

    <center>

        <br>
        <br>
        USER ID:-
        <input type="text" placeholder="User ID" ng-model="uid" 
        ng-init="uid='<?php echo $_SESSION["activeuser"]; ?>'" 
        value='<?php echo $_SESSION["activeuser"]; ?>' readonly>
        <br>
        <br>
        FROM DATE:- <input type="date" class="ml-1 mr-5" ng-model="dfrom">
        TO DATE:- <input type="date" class="ml-1 mr-5" ng-model="dto">
        <select id="konsi">
            <option>CHOOSE</option>
            <option>SUGAR TEST</option>
            <option>URINE TEST</option>
            <option>BOTH</option>
        </select>
        <div class="btn btn-info ml-5" style="width:200px;" ng-click="fetchAll();">FETCH</div>


        <br>
        <br>
        <table id="table1" class="table table-striped" style="width:1200px;" rules="all">
            <tr>
                <th ng-click="doSort('dateofrecord');">DATE</th>
                <th ng-click="doSort('timeofrecord');">TIME</th>
                <th ng-click="doSort('sugartime');">WHEN</th>
                <th ng-click="doSort('sugarresult');">S-RESULT</th>
            </tr>
            <tr ng-repeat="obj in jsonArray | orderBy:col">
                <td>{{obj.dateofrecord}}</td>
                <td>{{obj.timeofrecord}}</td>
                <td>{{obj.sugartime}}</td>
                <td>{{obj.sugarresult}}</td>
            </tr>
        </table>
        <table id="table2" class="table table-striped" style="width:1200px;" rules="all">
            <tr>
                <th ng-click="doSort('dateofrecord');">DATE</th>
                <th ng-click="doSort('timeofrecord');">TIME</th>
                <th ng-click="doSort('medintake');">MEDICINAL INTAKE</th>
                <th ng-click="doSort('urineresult');">U-RESULT</th>
            </tr>
            <tr ng-repeat="obj in jsonArray | orderBy:col">
                <td>{{obj.dateofrecord}}</td>
                <td>{{obj.timeofrecord}}</td>
                <td>{{obj.medintake}}</td>
                <td>{{obj.urineresult}}</td>
            </tr>
        </table>
        <table id="table3" class="table table-striped" style="width:1200px;" rules="all">
            <tr>
                <th ng-click="doSort('dateofrecord');">DATE</th>
                <th ng-click="doSort('timeofrecord');">TIME</th>
                <th ng-click="doSort('sugartime');">WHEN</th>
                <th ng-click="doSort('sugarresult');">S-RESULT</th>
                <th ng-click="doSort('medintake');">MEDICINAL INTAKE</th>
                <th ng-click="doSort('urineresult');">U-RESULT</th>
            </tr>
            <tr ng-repeat="obj in jsonArray | orderBy:col">
                <td>{{obj.dateofrecord}}</td>
                <td>{{obj.timeofrecord}}</td>
                <td>{{obj.sugartime}}</td>
                <td>{{obj.sugarresult}}</td>
                <td>{{obj.medintake}}</td>
                <td>{{obj.urineresult}}</td>
            </tr>
        </table>
    </center>
</body>

</html>
