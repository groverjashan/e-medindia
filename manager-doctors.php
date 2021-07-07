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
                $http.get("angular-fetch-doctors.php").then(Ok,notOk);
                function Ok(response)
                {
                    $scope.jsonArray=response.data;
                }
                function notOk(response)
                {
                    alert(response.data);
                }
            }
            $scope.doDelete=function(uid)
            {
                $http.get("angular-delete-doctors.php?uid="+uid).then(Ok,notOk);
                function Ok(response)
                {
                    alert(response.data);
                    $scope.fetchAll();
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
                background-color: ghostwhite
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
    <img src="pics/doc.jpg" width="80" height="80" class="align-content-md-center" style="border-radius:50%;" alt="">
         DOCTOR MANAGER
  </a>
</nav>
<br>
   <center>
       <div class="btn btn-dark" ng-click="fetchAll();">FETCH DOCTORS RECORD</div>
          <input type="text" class="ml-3" placeholder="Search" ng-model="googler.dname">

   <br>
   <br>
   <table class="table table-striped" rules="all">
       <tr>
           <th ng-click="doSort('uid');">USERNAME ID</th>
           <th ng-click="doSort('dname');">DOCTOR NAME</th>
           <th ng-click="doSort('contact');">CONTACT</th>
           <th ng-click="doSort('hospital');">HOSPITAL</th>
           <th ng-click="doSort('spl');">SPECIALITY</th>
           <th>PICTURE</th>
           <th>DELETE</th>
       </tr>
       <tr ng-repeat="obj in jsonArray | orderBy:col | filter:googler">
           <td>{{obj.uid}}</td>
           <td>{{obj.dname}}</td>
           <td>{{obj.contact}}</td>
           <td>{{obj.hospital}}</td>
           <td>{{obj.spl}}</td>
           <td><img src="uploads/{{obj.ppic}}" height="150" width="" alt=""></td>
           <td align="center"><input type="button" value="DELETE" ng-click="doDelete(obj.uid);"></td>
       </tr>
   </table>
   
   </center> 
</body>
</html>