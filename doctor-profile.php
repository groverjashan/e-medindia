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
    
        label{
            font-size: 20px;
            font-weight: 700;
            font-family:monospace;
        }
    </style>
    <script src="js/jquery-1.8.2.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    <script>
    
        function show(file) {

				if (file.files && file.files[0]) {
					var reader = new FileReader();
					reader.onload = function(ev) {
						$('#pic').attr('src', ev.target.result);
					}
					reader.readAsDataURL(file.files[0]);
				}

			}
        function show2(file) {

				if (file.files && file.files[0]) {
					var reader = new FileReader();
					reader.onload = function(ev) {
						$('#cpic').attr('src', ev.target.result);
					}
					reader.readAsDataURL(file.files[0]);
				}

			}
        
        $(document).ready(function(){
            
           $("#btnFetch").click(function(){
               //alert();
               var uid=$("#txtUid").val();
               $.getJSON("jsonfetch-doctor.php?uid="+uid,function(jsonArray){
                   //alert(JSON.stringify(jsonArray));
                   if(jsonArray.length==0)
                       {
                           alert("invalid uid");
                           return;
                       }
                   $("#txtDname").hide().val(jsonArray[0].dname).fadeIn();
                   $("#txtContact").hide().val(jsonArray[0].contact).fadeIn();
                   $("#txtSpl").hide().val(jsonArray[0].spl).fadeIn();
                   $("#txtQual").hide().val(jsonArray[0].qual).fadeIn();
                   $("#txtStudied").hide().val(jsonArray[0].studied).fadeIn();
                   $("#txtExp").hide().val(jsonArray[0].exp).fadeIn();
                   $("#txtHospital").hide().val(jsonArray[0].hospital).fadeIn();
                   $("#txtAddress").hide().val(jsonArray[0].address).fadeIn();
                   $("#txtCity").hide().val(jsonArray[0].city).fadeIn();
                   $("#txtEmail").hide().val(jsonArray[0].email).fadeIn();
                   $("#txtWebsite").hide().val(jsonArray[0].website).fadeIn();
                                      $("#jasus1").val(jsonArray[0].ppic);
$("#pic").hide().prop("src","uploads/"+jsonArray[0].ppic).fadeIn();
                                      $("#jasus2").val(jsonArray[0].cpic);
$("#cpic").hide().prop("src","uploads/"+jsonArray[0].cpic).fadeIn();
                   
                   $("#txtInfo").hide().val(jsonArray[0].info).fadeIn();
               })
           }) ;
        });
        
        
    </script>
    <title>Document</title>
</head>
<body>
   <center>
   <center class="mt-5">
       <div class="row">
           <div class="col-md-12">
               <h1 style="font-family: monospace">
                  
                   PROFILE DOCTOR
               </h1>
           </div>
       </div>
   <form action="doctor-process.php" method="post" enctype="multipart/form-data">
   <input type="hidden" name="jasus1" id="jasus1">
   <input type="hidden" name="jasus2" id="jasus2">
    <div class="container bg-light">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="txtUid">Username ID</label>
                <input type="text" id="txtUid" disabled name="txtUid" class="form-control"  value="<?php echo $_SESSION['activeuser']?>" readonly>
            </div>
            </div>
            <div class="col-md-3 offset-1">
                <label>&nbsp;</label>
                <input type="button" id="btnFetch" value="Fetch Profile" class="form-control btn btn-danger border-0 ml-5">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtDname">Name</label>
                <input type="text" class="form-control" required id="txtDname" name="txtDname">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtContact">Contact Number</label>
                <input type="text" class="form-control" required id="txtContact" name="txtContact">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtSpl">Specialisation</label>
                <select class="form-control" name="txtSpl" required id="txtSpl">
                   <option value="none">SELECT</option>
                     <option value="ALLERGY & IMMUNOLOGY">ALLERGY & IMMUNOLOGY</option>
                    <option value="ANESTHESIOLOGY">ANESTHESIOLOGY</option>
                    <option value="DERMATOLOGY">DERMATOLOGY</option>
                    <option value="DIAGNOSTIC RADIOLOGY">DIAGNOSTIC RADIOLOGY</option>
                    <option value="NEPHROLOGY">NEPHROLOGY</option>
                    <option value="HEMATOLOGY">HEMATOLOGY</option>
                    <option value="CARDIOVASCULAR">CARDIOVASCULAR</option>
                    <option value="NEUROLOGY">NEUROLOGY</option>
                    <option value="GYNECOLOGY">GYNECOLOGY</option>
                    <option value="PATHOLOGY">PATHOLOGY</option>
                    <option value="PSYCHIATRY">PSYCHIATRY</option>
                    <option value="SURGERY">SURGERY</option>
                    <option value="UROLOGY">UROLOGY</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtQual">Qualification</label>
                <input type="text" class="form-control" required id="txtQual" name="txtQual">
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtStudied">Studied from</label>
                <input type="text" class="form-control" required id="txtStudied" name="txtStudied">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtExp">Work Experience</label>
                <input type="text" class="form-control" required id="txtExp" name="txtExp">
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                <label for="txtHospital">Hospital</label>
                <input type="text" class="form-control" required id="txtHospital" name="txtHospital">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtAddress">Address</label>
                <input type="text" class="form-control" required id="txtAddress" name="txtAddress">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtCity">City</label>
                <input type="text" class="form-control" required id="txtCity" name="txtCity">
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtEmail">Email</label>
                <input type="email" class="form-control" required id="txtEmail" name="txtEmail">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="txtWebsite">Website</label>
                <input type="text" required class="form-control" id="txtWebsite" name="txtWebsite">
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <img src="pics/agent.jpg" id="pic" width="100" style="border-radius:50%;" height="100">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <img src="pics/agent.jpg" id="cpic" width="100" style="border-radius:50%;" height="100">
            </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                <label for="profilePic">Upload Profile Pic</label>
                <input type="file" required onchange="show(this);" id="profilePic" name="profilePic" style="cursor:pointer;">
            </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="certiPic">Upload Certificate</label>
                <input type="file" required onchange="show2(this);" id="certiPic" name="certiPic" style="cursor:pointer;">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                   <label for="txtInfo">Other Info (optional)</label>
                    <textarea id="txtInfo" name="txtInfo" cols="120" rows="5"></textarea>
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