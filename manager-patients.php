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
    
        $module=angular.module("mymodule",[]);
        $module.controller("mycontroller",function($scope,$http){
            $scope.jsonArray;
            $scope.fetchAll=function()
            {
                $http.get("angular-fetch-patients.php").then(Ok,notOk);
                function Ok(response)
                {
                    $scope.jsonArray=response.data;
                }
                function notOk(response)
                {
                    alert(response.data);
                }
            }
            $scope.doSort=function(cname)
            {
                $scope.col=cname;
            }
        })
    </script>
    <style>
            #bg {/*
            background-image: url(pics/0ca4ed27-205c-46eb-8e1b-a3ba727485cd.jpg);
            background-size: cover;
            background-repeat: no-repeat;*/
                background-color: whitesmoke
        }

        th{
            cursor: pointer;
        }
    </style>
</head>
<body ng-app="mymodule" ng-controller="mycontroller" id="bg">
<!-- Image and text -->
<nav class="navbar navbar-light">
  <a class="navbar-brand" href="#">
    <img src="pics/patient.jpg" width="80" height="80" class="align-content-md-center" style="border-radius:50%;" alt="">
         PATIENT MANAGER
  </a>
</nav>
   <br>

   <center>
      
       <div class="btn btn-info" ng-click="fetchAll();">FETCH PATIENTS RECORD</div>
       <input type="text" class="ml-3" placeholder="Search" ng-model="googler.name">
        
   
   <br>
   <br>
   <table class="table table-striped" rules="all">
       <tr>
           <th ng-click="doSort('uid');">USERNAME ID</th>
           <th ng-click="doSort('name');">NAME</th>
           <th ng-click="doSort('gender');">GENDER</th>
           <th ng-click="doSort('city');">CITY</th>
           <th ng-click="doSort('contact');">CONTACT</th>
           <th ng-click="doSort('problems');">PROBLEM</th>
       </tr>
       <tr ng-repeat="obj in jsonArray | orderBy:col | filter:googler">
           <td>{{obj.uid}}</td>
           <td>{{obj.name}}</td>
           <td>{{obj.gender}}</td>
           <td>{{obj.city}}</td>
           <td>{{obj.contact}}</td>
           <td>{{obj.problems}}</td>
       </tr>
   </table>
   </center> 
</body>
</html>