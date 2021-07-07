<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .bg{
            background-color: aliceblue;
        }
        label{
            font-size: 20px;
            font-weight: 700;
            font-family:serif;
        }
    </style>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
       //alert();
        $("#btnFetch").click(function(){
           
        var uid=$("#txtUid").val();
        $.getJSON("jsonfetch-patient.php?uid="+uid,function(jsonArray){
            //alert(jsonArray);
            $("#txtName").val(jsonArray[0].name);
            $("#txtGender").val(jsonArray[0].gender);
            $("#txtAge").val(jsonArray[0].age);
            $("#txtAddress").val(jsonArray[0].address);
            $("#txtCity").val(jsonArray[0].city);
            $("#txtEmail").val(jsonArray[0].email);
            $("#txtContact").val(jsonArray[0].contact);
            $("#txtProblems").val(jsonArray[0].problems);
        }); 
        });
    });
    </script>
        <title>Document</title>
</head>
<body class="bg">
    <center class="mt-5">
       <div class="row">
           <div class="col-md-12">
               <h1 style="font-family: monospace">
                  
                   PROFILE PATIENT
               </h1>
           </div>
       </div>
        <form action="patient-process.php" method="post" enctype="multipart/form-data">
            <div class="container">
               <div class="row">
                   <div class="col-md-4 offset-2">
                       <div class="form-group">
                           <label for="txtUid">USERNAME ID</label>
                           <input type="text" class="form-control" required name="txtUid" id="txtUid"  
                           value='<?php echo $_SESSION["activeuser"];?>' readonly>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="form-group">
                           <label>&nbsp;</label>
                           <input type="button"  id="btnFetch" value="Fetch Profile" class="form-control btn btn-secondary border-0 ml-5">
                       </div>
                   </div>
               </div>
                
                <div class="row">
                    <div class="col-md-4 offset-2">
                        <div class="form-group">
                            <label for="txtName">NAME</label>
                            <input type="text" name="txtName" id="txtName" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3 ml-5">
                        <div class="form-group">
                            <label for="txtGender">GENDER</label>
                            <select name="txtGender" id="txtGender" required class="form-control">
                                <option value="none">SELECT</option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 offset-2">
                        <div class="form-group">
                            <label for="txtAge">AGE</label>
                            <input type="number" name="txtAge" id="txtAge" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5 ml-5">
                        <div class="form-group">
                            <label for="txtAddress">ADDRESS</label>
                            <input type="text" name="txtAddress" id="txtAddress" required class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 offset-2">
                        <div class="form-group">
                            <label for="txtCity">CITY</label>
                            <input type="text" required name="txtCity" id="txtCity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txtEmail">EMAIL</label>
                            <input type="email" required name="txtEmail" id="txtEmail" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txtContact">CONTACT</label>
                            <input type="text" required name="txtContact" id="txtContact" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="form-group">
                            <label for="txtProblems">HEALTH PROBLEMS</label>
                            <input type="text" required name="txtProblems" id="txtProblems" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="btn" value="Submit" class="btn btn-success">
                            <input type="submit" name="btn" value="Update" class="btn btn-info ml-3">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </center>
</body>
</html>