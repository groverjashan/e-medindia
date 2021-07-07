<?php
session_start();
if(isset($_SESSION["activeuser"])==false)
{
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        
        #bg {
            background-color: lavender
        }
        .container {
            margin: 90px 0 50px 0;
        }
        img {
			border-radius: 50%;
			border:1px black solid;
			transition: ease all 1s;
		}
        .btn {
            width: 100%;
            }
        .card
        {
            padding: 25px 10px 0 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.3);
            transition: all 0.4s ease;
            min-height: 300px;
                
        }
        .card:hover {
            box-shadow: 0px 10px 30px rgba(0,0,0,0.3);
            transform: translateY(-3px);
        }
       .card img{
            max-width:180px;
            max-height:180px;
        }
        label {
            font-weight: bold;
            font-size: 18px;
            font-family: cursive;
        }
        .modal-body
        {
            background-image: url(pics/bgm.jpg);
            background-size: cover;
            background-position:center;
            background-repeat: no-repeat;
        }
        
    </style>
    <script src="js/jquery-1.8.2.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
       $("#btnRecord").click(function(){
           var uid=$("#txtUid").val();
           var dor=$("#txtDate").val();
           var dia=$("#txtDia").val();
           var syst=$("#txtSyst").val();
           var pulse=$("#txtPulse").val();
           $.get("ajax-bprecord.php?uid="+uid+"&dor="+dor+"&dia="+dia+"&syst="+syst+"&pulse="+pulse,function(response){
               $("#res").html(response);
           });
           
           if(syst<120)
           $("#pres").html("NORMAL").css("color","green");
           if(syst>=120&&syst<130)
           $("#pres").html("ELEVATED").css("color","yellow");
           if(syst>=130&&syst<140)
           $("#pres").html("HIGH BLOOD PRESSURE STAGE1").css("color","orange");
           if(syst>=140&&syst<180)
           $("#pres").html("HIGH BLOOD PRESSURE STAGE2").css("color","brown");
           if(syst>=180)
           $("#pres").html("HYPERTENSIVE").css("color","red");
       });
        
        //=-=-=-=-=-=-=
        
        $("#btnRecord2").click(function(){
            var uid=$("#txtUid2").val();
            var dor=$("#txtDate2").val();
            var tor=$("#txtTime").val();
            var sugartime=$("#txtWhen").val();
            var sugarresult=$("#txtResult").val();
            var medintake=$("#txtMed").val();
            var urineresult=$("#txtResult2").val();
            $.get("ajax-sugarrecord.php?uid="+uid+"&dor="+dor+"&tor="+tor+"&sugartime="+sugartime+"&sugarresult="+sugarresult+"&medintake="+medintake+"&urineresult="+urineresult,function(response){
               $("#sres").html(response);
           });
           
        })
    });
    </script>

    <title>Document</title>
</head>

<body id="bg">
   
   
   <nav class="navbar navbar-light fixed-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#">
  <img src="pics/patient.jpg" width="50" height="50" alt="">     PATIENT DASHBOARD</a>
    Welcome <?php echo $_SESSION["activeuser"];?>
</nav>
    <center>
        <div class="container">
            <div class="row text-warning">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            
            <div class="row mt-3 mb-3">
                <div class="col-md-3 offset-1">
                    <div class="card bg-transparent border-0">
                        <img src="pics/patirntprofile2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="profile-patient.php" class="btn btn-success">PROFILE PATIENT</a>
                        </div>
                    </div>

                </div>
                
                <div class="col-md-3 ml-5">
                    <div class="card bg-transparent border-0">
                        <img src="pics/doc.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        <a href="doctor-search.php" class="btn btn-success">SEARCH DOCTOR</a>
                        </div>
                    </div>
                </div>
                   <div class="col-md-3 ml-5">
                    <div class="card bg-transparent border-0">
                        <img src="pics/LO.png" class="card-img-top" alt="...">
                        <div class="card-body">
                        <a href="logout.php" class="btn btn-success">LOGOUT</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mb-3">
               
               <div class="col-md-3 offset-1">
                    <div class="card bg-transparent">
                        <img src="pics/pslip.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="doctor-slip-front.php" class="btn btn-success">PRESCRIPTION SLIP</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ml-5">
                    <div class="card bg-transparent border-0">
                        <img src="pics/bp2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#bpModal">RECORD BP</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ml-5">
                    <div class="card bg-transparent border-0">
                        <img src="pics/sr2.png" class="card-img-top" alt="...">
                        <div class="card-body">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#sugarModal">RECORD SUGAR</button>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
               
                <div class="col-md-3 offset-1">
                    <div class="card bg-transparent">
                        <img src="pics/hist.png" class="card-img-top" alt="...">
                        <div class="card-body">
                        <a href="history-bp.php" class="btn btn-success">BP HISTORY</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 ml-5">
                    <div class="card bg-transparent">
                        <img src="pics/hists.png" class="card-img-top" alt="...">
                        <div class="card-body">
                        <a href="history-sugar.php" class="btn btn-success">SUGAR HISTORY</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ml-5">
                    <div class="card bg-transparent">
                        <img src="pics/histslip.png" class="card-img-top bg-white" alt="...">
                        <div class="card-body">
                        <a href="history-slips.php" class="btn btn-success">SLIPS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--BP-Modal -->
    <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="bpModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <label class="modal-title" id="bpModal"><h3>Record BP Here</h3></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <center>
                        <form>
                           <div class="container">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtUid">USERNAME ID</label>
                                       <input type="text" name="txtUid" id="txtUid" class="form-control" value='<?php echo $_SESSION["activeuser"]?>' readonly>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtDate">DATE OF RECORD</label>
                                       <input type="date" name="txtDate" id="txtDate" class="form-control" required>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtDia">DIASTOLIC(LOW)</label>
                                       <input type="text" name="txtDia" id="txtDia" class="form-control" required>
                                   </div>
                               </div>
                                  <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtSyst">SYSTOLIC(HIGH)</label>
                                       <input type="text" name="txtSyst" id="txtSyst" class="form-control" required>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-md-6 offset-3">
                               <div class="form-group">
                                   <label for="txtPulse">PULSE</label>
                                   <input type="text" name="txtPulse" id="txtPulse" class="form-control" required>
                                   <span id="pres">*</span>
                               </div>
                               </div>
                           </div>
                            <div class="form-group mt-2">
                            <input type="button" id="btnRecord" class="btn btn-primary" value="Record">
                             </div>
                            </div>
                        </form>
                        <span id="res">&nbsp;</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <!--Sugar-Modal -->
    <div class="modal fade" id="sugarModal" tabindex="-1" role="dialog" aria-labelledby="bpModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <label class="modal-title" id="bpModal"><h3>Record SUGAR Here</h3></label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <center>
                        <form>
                           <div class="container">
                           <div class="row">
                               <div class="col-md-6 offset-3">
                                   <div class="form-group">
                                       <label for="txtUid2">USERNAME ID</label>
                                       <input type="text" name="txtUid2" id="txtUid2" class="form-control" value="<?php echo $_SESSION["activeuser"]; ?>" readonly>
                                   </div>
                               </div>
                               </div>
                               <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtDate2">DATE OF RECORD</label>
                                       <input type="date" name="txtDate2" id="txtDate2" class="form-control" required>
                                   </div>
                               </div>
                                  <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="txtTime">TIME</label>
                                       <input type="time" name="txtTime" id="txtTime" class="form-control" required>
                                   </div>
                               </div>
                           </div>
                            <fieldset class="border border-dark">
                            <legend class="w-auto">BLOOD SUGAR</legend>
                           <div class="row">
                               <div class="col-md-10 offset-1">
                                   <div class="form-group">
                                       <label for="txtWhen">WHEN</label>
                                       <select name="txtWhen" id="txtWhen" required class="form-control">
                                           <option value="none">CHOOSE</option>
                                           <option value="FASTING">FASTING</option>
                                           <option value="BEFORE MEAL">BEFORE MEAL</option>
                                           <option value="AFTER MEAL">AFTER MEAL</option>
                                           <option value="BEFORE EXERCISE">BEFORE EXERCISE</option>
                                           <option value="BED TIME">BED TIME</option>
                                       </select>
                                   </div>
                               </div>
                                </div>
                                 <div class="row">
                                  <div class="col-md-5 offset-1">
                                   <div class="form-group">
                                       <label for="txtAge">AGE</label>
                                       <input type="text" name="txtAge" id="txtAge" class="form-control" required>
                                   </div>
                               </div>
                                  <div class="col-md-5">
                                   <div class="form-group">
                                       <label for="txtResult">RESULT</label>
                                       <input type="text" name="txtResult" id="txtResult" value="0" class="form-control" required>
                                   </div>
                               </div>
                           </div>
                           </fieldset>
                           <fieldset class="border border-dark ">
                           <legend class="w-auto">URINE SUGAR</legend>
                           <div class="row">
                               <div class="col-md-6 offset-1">
                               <div class="form-group">
                                   <label for="txtMed">MEDICINAL INTAKE</label>
                                   <input type="text" name="txtMed" id="txtMed" class="form-control" required>
                               </div>
                               </div>
                               <div class="col-md-4">
                               <div class="form-group">
                                   <label for="txtResult2">RESULT</label>
                                   <input type="text" name="txtResult2" id="txtResult2" value="0" class="form-control" required>
                                   
                               </div>
                               </div>
                           </div>
                           </fieldset>
                            <div class="form-group mt-2">
                            <input type="button" id="btnRecord2" class="btn btn-primary" value="Record">
                             </div>
                             <span id="sres"></span>
                            </div>
                        </form>
                        <span id="res">&nbsp;</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
    
    </center>
</body>

</html>
