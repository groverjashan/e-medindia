<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <style>
        body {
            background-color: mintcream;
            
        }
        .navbar{
            background-color: lavender;
        }
        label {
            font-weight: bold;
            font-size: 18px;
            font-family:monospace;
        }

        .form-group {
            width: 70%;
        }

        #crd {
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;


        }

        #crd:hover {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
        }

        .col-md-11 {
            background-color: black;
            transform: skew(-14deg);
            
            border-right: 10px solid #E94B3CFF;
        }
        h3{
            font-size: 32px;
            font-family: serif;
            padding: 6PX;
            transform: skew(14deg);
            color: mintcream
        }
        #pcrd {
            padding: 25px 10px 0 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0px 5px 10px rgba(0,0,0,0.3);
            }
        #pcrd img{
            height:250px;
            width:250px;
            border-radius:10px;
            border:1px black solid;
            
        }
    </style>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        var ju = false;
        var jm = false;
        var jp = false;
        $(document).ready(function() {

            $("#btnSignup").click(function() {
                //alert();

                if (ju == false || jp == false || jm == false) {
                    alert("fill valid data");
                    return;
                }
                var uid = $("#txtUid").val();
                var pwd = $("#txtPwd").val();
                var mob = $("#txtMob").val();
                var category;
                if ($("#doctor").prop("checked") == true)
                    category = $("#doctor").val();
                if ($("#patient").prop("checked") == true)
                    category = $("#patient").val();
                $.get("ajax-signup.php?uid=" + uid + "&pwd=" + pwd + "&mob=" + mob + "&category=" + category, function(response) {
                    $("#res").html(response);
                });
            });

            //==-=-=-==-=-

            $("#btnLogin").click(function() {
                //alert();
                var uid = $("#Uid").val();
                var pwd = $("#Pwd").val();

                $.get("ajax-login.php?uid=" + uid + "&pwd=" + pwd, function(response) {
                    if (response == "Doctor")
                        location.href = "doctor-profile.php";
                    else if (response == "Patient") {
                        location.href = "dashboard-patient.php";
                    } else
                        $("#res2").html(response);
                });
            });


            //=-==-=-==-=-=


            $("#forgotpwd").click(function() {
                $("#login-Modal").modal('hide');
            });
            //==-=-=-==-=-

            $("#btnForgot").click(function() {
                //alert();
                var uid = $("#FUid").val();
                $.get("ajax-forgot.php?uid=" + uid, function(response) {
                    //alert(response);
                    $("#res3").html(response);
                });
            });

            //==-=-=-=-=-=-=

            $("#txtUid").blur(function() {
                var uid = $(this).val();
                if (uid==""||uid.length<3) {
                    $("#errUid").html("Invalid").css("color", "red");
                    ju = false;
                } else {
                    $("#errUid").html("Valid").css("color", "green");
                    ju = true;
                }
            });

            //==-=-=-=-=-=-=

            $("#txtPwd").blur(function() {
                var pwd = $(this).val();
                var r = /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
                var result = r.test(pwd);
                if (result == false) {
                    $("#errPwd").html("Invalid").css("color", "red");
                    jp = false;
                } else {
                    $("#errPwd").html("Valid").css("color", "green");
                    jp = true;
                }
            });

            //==-=-=-=-=-=-=

            $("#txtMob").blur(function() {
                var mob = $(this).val();
                var r = /^[6-9]{1}[0-9]{9}$/;
                var result = r.test(mob);
                if (result == false) {
                    $("#errMob").html("Invalid").css("color", "red");
                    jm = false;
                } else {
                    $("#errMob").html("Valid").css("color", "green");
                    jm = true;
                }
            });

        });

    </script>
    <title>Document</title>
</head>

<body>

    <!--navbar-->
    <nav class="navbar navbar-expand-sm navbar-light">
        <a class="navbar-brand" href="#">
            <img src="pics/41%20(1).gif" width="60">
        </a>
        <div class="navbar-brand" style="font-size:40px; margin-left:450px;" href="#">
            DOC-PAT
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <a class="nav-link font-weight-bold" style="cursor:pointer;" data-toggle="modal" data-target="#signup-Modal">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" style="cursor:pointer;" data-toggle="modal" data-target="#login-Modal">Login</a>

                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 offset-2">


                <!--CROUSEL-->
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="pics/c1.jpg" style="height:400px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="pics/c3.gif" style="height:400px;">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="pics/cr4.jpg" style="height:400px;">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-11 offset-1">
                <center>
                    <h3>Our Services</h3>
                </center>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-2 offset-sm-2">
                <div class="card border-dark" id="crd" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:120px;width:120px;margin-left:60px;margin-top:20px;border-radius:50%" src="pics/serd3.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Search Doctor</h6>
                        </center>
                        <p class="card-text text-muted text-center">Search doctors in your any city.</p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-dark" id="crd" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:110px;width:120px;margin-left:60px;margin-top:20px;margin-bottom:10px;border-radius:20%" src="pics/pslip.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Upload Prescription Slip</h6>
                        </center>
                        <p class="card-text text-muted text-center">Save prescription slips for future necessities. </p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-dark" id="crd" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:110px;width:120px;margin-left:60px;margin-top:20px;margin-bottom:10px;border-radius:50%" src="pics/reg.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">Doctor Registration</h6>
                        </center>
                        <p class="card-text text-muted text-center">Register here for better reach.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-sm-2 offset-sm-3">
                <div class="card border-dark" id="crd" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:110px;width:120px;margin-left:60px;margin-top:20px;border-radius:50%" src="pics/history.png">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">BP/Sugar History</h6>
                        </center>
                        <p class="card-text text-muted text-center">Have a record of Sugar and BP history.</p>
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="col-sm-2 offset-sm-1">
                <div class="card border-dark" id="crd" style="width: 15rem; height:250px">
                    <img class="card-img-top" alt="Card image cap" style="height:110px;width:120px;margin-left:60px;margin-top:20px;border-radius:50%" src="pics/ssdata.jpg">
                    <div class="card-body">
                        <center>
                            <h6 class="card-title text-info">SECURE DATA</h6>
                        </center>
                        <p class="card-text text-muted text-center">Be aware <br>Connect With Care.</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-11 offset-1">
                <center>
                    <h3>Reach Us</h3>
                </center>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-md-5 offset-sm-1 mr-3">
                <div class="card border-dark">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13791.165596140429!2d74.9559475!3d30.214500649999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a495d7f7df%3A0xfd73fea160762546!2zMzDCsDEyJzQ0LjciTiA3NMKwNTcnMDQuMyJF!5e0!3m2!1sen!2sin!4v1595763662804!5m2!1sen!2sin" width="443" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            &nbsp;
            <div class="col-md-5 ml-5">
                <div class="card border-dark">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDoc-Pat-110255130777230&tabs=timeline&width=443&height=250&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="443" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></div>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-md-11 offset-1">
                <center>
                    <h3>Meet The Developer</h3>
                </center>
            </div>
        </div>
    
    <div class="row mt-3">
        <div class="col-sm-4 offset-2">
            <div class="card" id="pcrd">
                <img class="card-img-top" src="pics/me.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Deshiv Garg</h5>
                    <p class="card-text">
                        Currently pursuing Mechanical Engineering At PEC University
                    </p>
                    <p class="card-text">
                        <a href="https://www.linkedin.com/in/deshiv-garg-36a22a1a8/" target="_blank" class="card-link">Full Stack Developer</a>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 ml-5">
            <div class="card" id="pcrd">
                <img class="card-img-top" src="pics/me.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Rajesh Bansal</h5>
                    <p class="card-text">
                    My mentor who guided me along the project
                    
                    </p>
                    <p class="card-text">
                        <a href="http://www.banglorecomputereducation.com/" target="_blank" class="card-link">Banglore Computer Education</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
<br>
<br>
            <h4 style="background-color:dimgray;padding:4px;color:mintcream;">
            Copyrights © by Deshiv
            </h4>


    <!--SignUP- Modal -->
    <div class="modal fade" id="signup-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SignUp Here</h5>
                    <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-4 mb-4">
                            <img src="pics/sp2.jpg" height="150px" width="150px">
                        </div>
                    </div>
                    <center>
                        <form>
                            <div class="form-group">
                                <input type="text" placeholder="Username ID" class="form-control" id="txtUid">
                                <span id="errUid"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" id="txtPwd">
                                <span id="errPwd"></span>
                            </div>
                            <div class="form-group">
                                    <div class="input-group" style="">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+91</span>
                                        </div>
                                <input type="text" placeholder="Mobile Number" class="form-control" id="txtMob">
                            </div>
                             <span id="errMob"></span>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category" id="doctor" value="Doctor">
                                <label class="form-check-label" for="doctor">Doctor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="category" id="patient" value="Patient">
                                <label class="form-check-label" for="patient">Patient</label>
                            </div>
                            <div class="form-group mt-2">
                                <button type="button" id="btnSignup" class="btn btn-primary">Signup</button>
                            </div>
                        </form>
                        <span id="res"></span>

                    </center>
                </div>
            </div>
        </div>
    </div>



    <!--LOgin- Modal -->
    <div class="modal fade" id="login-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Here</h5>
                    <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-4 mb-4">
                            <img src="pics/lp.png" height="150px" width="150px">
                        </div>
                    </div>
                    <center>
                        <form>
                            <div class="form-group">
                                <input type="text" placeholder="Username ID" class="form-control" id="Uid">
                                <span id="Uid"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" id="Pwd">
                            </div>
                            <div class="form-group">

                                <a id="forgotpwd" data-toggle="modal" data-target="#forgot-Modal" style="font-weight:bold; font-size:18px; cursor:pointer;">Forgot Password?</a>
                            </div>
                            <button type="button" id="btnLogin" class="btn btn-primary">Login</button>

                        </form>
                        <span id="res2"></span>
                    </center>
                </div>
            </div>
        </div>
    </div>


    <!--Forgot- Modal -->
    <div class="modal fade" id="forgot-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORGOT PASSWORD</h5>
                    <button type="button" class="close bg-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>
                        <form>
                            <div class="form-group">
                                <label for="FUid">Username ID</label>
                                <input type="text" class="form-control" id="FUid">
                            </div>
                            <button type="button" id="btnForgot" class="btn btn-primary">REQUEST</button>

                        </form>
                        <span id="res3"></span>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
