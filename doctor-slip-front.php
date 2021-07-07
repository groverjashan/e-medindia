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
        .bg {
        background-color: aliceblue;
        }

        label {
            font-size: 24px;
            font-weight: 700;
            font-family: serif;
        }
        
    </style>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        function show(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#spic').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }

        }

    </script>

    <title>Document</title>
</head>

<body class="bg">
    <center>
        <div class="row">
            <div class="col-md-12">
                <h1 style="font-family: monospace">
                    SLIP INFORMATION
                </h1>
            </div>
        </div>
        <form action="doctor-slip-process.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-2">
                        <div class="form-group">
                            <label for="txtUid">USERNAME ID</label>
                            <input type="text" class="form-control" required name="txtUid" id="txtUid" value='<?php echo $_SESSION["activeuser"]; ?>' readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="txtDname">DOCTOR NAME</label>
                            <input type="text" name="txtDname" id="txtDname" required class="form-control" autofocus>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 offset-2">
                        <div class="form-group">
                            <label for="txtCity">CITY</label>
                            <input type="text" required name="txtCity" id="txtCity" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="txtHospital">HOSPITAL</label>
                            <input type="text" required name="txtHospital" id="txtHospital" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 offset-1">
                        <div class="form-group">
                            <label for="txtProblem">PROBLEM</label>
                            <input type="text" id="txtProblem" name="txtProblem" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txtDov">DATE OF VISIT</label>
                            <input type="date" required class="form-control" id="txtDov" name="txtDov">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txtNextdov">NEXT DATE OF VISIT</label>
                            <input type="date" required class="form-control" id="txtNextdov" name="txtNextdov">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 offset-1">
                        <div class="form-group">
                            <label for="txtDiscussion">DISCUSSION</label>
                            <textarea name="txtDiscussion" id="txtDiscussion" cols="60" class="form-control" rows="7s"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slipPic">UPLOAD SLIP PIC</label>
                            <br>
                            <img src="pics/agent.jpg" id="spic" width="200" style="border-radius:50%;" height="150">
                            <br>
                            <input type="file" required onchange="show(this);" id="slipPic" name="slipPic" style="cursor:pointer;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="btn" value="Sent To Server" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </center>
</body>

</html>
