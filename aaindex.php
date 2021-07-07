<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Index Page</title>
    <style>
        .bg-image {
            background-color: ;
        }

    </style>



    <script>
        $(document).ready(function() {

            $("#suid").blur(function() {
                var uid = $(this).val();

                var mail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                var na = /^[a-zA-Z ]*$/;
                var result = na.test(uid);
                var result2 = mail.test(uid);

                if (uid == "") {
                    $(".naame").html("Invalid");
                } else
                if (result == true || result2 == true) {
                    $(".naame").html("Valid").css("color", "green");
                } else {
                    $(".naame").html("Invalid").css("color", "red");;
                }

            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#spwd").blur(function() {
                var signpwd = $(this).val();

                var rsignpwd = /(?=^.{8,10}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
                var ressignpwd = rsignpwd.test(signpwd);

                if (ressignpwd == false) {
                    $(".pass").html("Invalid").css("color", "red");;
                } else {
                    $(".pass").html("Valid").css("color", "green");;
                }

            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#smob").blur(function() {

                var mob = $(this).val();

                var chkmob = /^\d{3}\d{3}\d{4}$/;
                var chkmobile = chkmob.test(mob);

                if (chkmobile == false) {
                    $(".mobile").html("Invalid").css("color", "red");;
                } else {
                    $(".mobile").html("Valid").css("color", "green");;
                }
            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=


            $("#signup").click(function() {
                $("#sign").html("");
                $(".naame").html("");
                $(".mobile").html("");
                $(".pass").html("");
            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#signUp").click(function() {
                var uid = $("#suid").val();
                var pwd = $("#spwd").val();
                var contact = $("#smob").val();
                if ($("#categoryD").prop("checked") == true) {
                    var category = $("#categoryD").val();
                }
                if ($("#categoryP").prop("checked") == true) {
                    var category = $("#categoryP").val();
                }

                var url = "signup-process.php?suid=" + uid + "&spwd=" + pwd + "&smob=" + contact + "&category=" + category;

                $.get(url, function(response) {
                    $("#sign").html(response).css("font-size", "16px").css("color", "green");

                    $("#signnup").trigger("reset");


                });
            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#loginbtn").click(function() {
                var uid = $("#luid").val();
                var pwd = $("#lpwd").val();
                var loginurl = "login-check.php?luid=" + uid + "&lpwd=" + pwd;

                $.get(loginurl, function(response) {
                    $("#loginn").trigger("reset");
                    /*alert(response);
                    $("#chkuid").html(response).css("font-size", "14px").css("color", "green");*/
                    if (response == "Not Valid")
                        alert("Enter valid data");
                    else
                    if (response == "Patient")
                        location.href = "dashboard-patient.php";
                    else
                    if (response == "Doctor")
                        location.href = "doctor-profile.php";

                });

            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#forg").click(function() {
                $("#login").modal('hide');
            });

            //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

            $("#sendsms").click(function() {

                var uid = $("#uid").val();
                var url = "forgot-password.php?uid=" + uid;
                $.get(url, function(response) {
                    alert(response);
                    $("#forgot").trigger("reset");
                });

            });
        });

    </script>
</head>

<body class="bg-image">
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color:ghostwhite">
        <a class="navbar-brand" href="#">
            <img src="pics/heart.gif" style="width:60px; height:60px; border-radius:50%" class="d-inline-block ">
        </a>
        <a class="navbar-brand" href="#">
             E-Health
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#signup"><i class="fa fa-sign-in"></i><b>Sign Up</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#login"><b>Login</b></a>
                </li>
            </ul>
        </div>
    </nav>
    <!--corousel-->
    <div class="container">
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div id="slide" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="pics/gif3.gif" style="height:200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <center>
                    <h4 class="text-danger">Our Services</h4>
                    <hr size="100px" align="center">
                </center>
            </div>

        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-sm-2 mr-2">
                <div class="card border-warning" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:100px;width:100px;margin-left:70px;margin-top:20px;border-radius:50%" src="icons/serdoc.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Search Doctor</h6>
                        </center>
                        <p class="card-text text-muted">You can search doctors here from any city.</p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-warning" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:100px;width:100px;margin-left:70px;margin-top:20px;border-radius:50%" src="pics/timer22.jpg">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">BP/Sugar History</h6>
                        </center>
                        <p class="card-text text-muted">You can see your sugar and bp record history.</p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-warning" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:90px;width:90px;margin-left:70px;margin-top:20px;margin-bottom:10px;border-radius:50%" src="pics/slippppp.jpg">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Upload Prescription Slip</h6>
                        </center>
                        <p class="card-text text-muted">You can save your slips for future purposes. </p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-warning" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:90px;width:90px;margin-left:70px;margin-top:20px;margin-bottom:10px;border-radius:50%" src="pics/RegisterIcon2.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Doctor Registration</h6>
                        </center>
                        <p class="card-text text-muted">You can register here.......</p>
                    </div>
                </div>
            </div>

            <div class="row">
                &nbsp;
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>


        <div class="row">
            <div class="col-8 offset-2">
                <center>
                    <h4 class="text-danger"> Meet The Developer</h4>
                    <hr size="100px" align="center">
                </center>
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-sm-2">
                <img src="pics/dev.png" style="height:150px;width:150px;border-radius:50%">
            </div>

            <div class="col-sm-6 offset-sm-1">
                <p style="text-success">I am <b>Ayushika</b> ,an Engineering student of second year. Currently pursuing B.Tech degree in CSE(Computer Science Engineering).This is my first project under the guidance of <b>Mr. Rajesh Bansal,</b> training head at Sun-Soft Technologies and founder of Bangalore Computer Education author of <b>"Real Java"</b></p>
            </div>

            <div class="col-sm-2 offset-sm-1">
                <img src="pics/dev.png" style="height:150px;width:150px;border-radius:50%">
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <center>
                    <h4 class="text-danger">Reach Us</h4>
                    <hr size="100px" align="center">
                </center>
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-sm-3 offset-sm-2">
                <div class="card border-dark" style="width: 16rem; height:200px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.880733791611!2d74.95013941490265!3d30.211951281821623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1595741215204!5m2!1sen!2sin" width="251px" height="200px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-3 offset-sm-2">
                <div class="card border-dark" style="width: 16rem; height:200px">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/E-health-117304116739195/?modal=admin_todo_tour" width="251px" height="200px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
        </div>
        <div class="row">
            &nbsp;
        </div>
        <div class="row">
            &nbsp;
        </div>

        <div class="row" style="background-color:#CCD6DD">
            <div class="col-12">
                <center>
                    <h6>copyright</h6>
                </center>
            </div>
        </div>
    </div>



    <!--Signup modal-->
    <div class="modal fade bg-image" id="signup" tabindex="-2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:ghostwhite">
                    <h5 class="modal-title">Signup Here!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="signnup">
                        <div class="row">
                            <div class="col-md-6 offset-md-4 mb-4">
                                <img src="pics/profile.png" height="150px" width="150px">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username/email" name="suid" id="suid">
                            <div class="naame"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="spwd" id="spwd" data-toggle="tooltip" data-placement="bottom" title="It must be 8-10 characters long and it contains atleast one capital letter,One small letter,one special character and one digit">
                            <div class="pass"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Contact No" name="smob" id="smob">
                            <div class="mobile"></div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" value="Doctor" id="categoryD">
                            <label class="form-check-label" for="categoryD">
                                Doctor
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category" value="Patient" id="categoryP">
                            <label class="form-check-label" for="categoryP">
                                Patient
                            </label>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <center>
                            <button type="button" class="btn btn-outline-success btn-md" id="signUp">Sign Up</button>
                        </center>
                        <span id="sign"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Login modal-->
    <div class="modal fade bg-image" id="login" tabindex="-2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:ghostwhite">
                    <h5 class="modal-title">Login Here!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginn">
                        <div class="row">
                            <div class="col-md-6 offset-md-4 mb-4">
                                <img src="pics/profile.png" height="150px" width="150px">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="luid" id="luid">
                            <span id="chkuid"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="lpwd" name="lpwd">
                        </div>
                        <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#open" class="font-weight-light text-muted" id="forg"><b>Forgot Password?</b></a>
                        </div>
                        <center>
                            <button type="button" class="btn btn-outline-success btn-md" id="loginbtn">Login</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bg-image" id="open" tabindex="-2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:ghostwhite">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgot">
                        <input type="text" placeholder="Enter Your User Id" class="form-control" id="uid" name="uid">
                        <br>
                        <center>
                            <input type="button" class="btn btn-outline-danger btn-sm" value="Send Sms" id="sendsms">
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--forgot password-->


</body>

</html>
