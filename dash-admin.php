<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        #bg {
            background-image: url(pics/bga.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container{
            margin-top: 7%;
        }
    </style>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body id="bg">
        <div class="container">
            <div class="row text-warning">
                <div class="col-md-12" style="margin-left:6%;">
                    <h1 style="font-family:cursive; font-weight:700">
                        ADMIN DASHBOARD
                    </h1>
                </div>
            </div>
            <center>
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card bg-transparent border-0">
                        <img src="pics/doc.jpg" class="card-img-top rounded-circle" alt="...">
                        <div class="card-body">
                            <a href="manager-doctors.php" class="btn btn-info">DOCTORS MANAGER</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="card bg-transparent border-0">
                        <img src="pics/patient.jpg" class="card-img-top rounded-circle" alt="...">
                        <div class="card-body">
                            <a href="manager-patients.php" class="btn btn-success">PATIENTS MANAGER</a>
                        </div>
                    </div>

                </div>
            </div>
    </center>
        </div>
</body>

</html>
