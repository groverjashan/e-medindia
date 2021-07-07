<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Index</title>
    <style>
        .valid {
            box-shadow: none !important;
            box-shadow: 0px 0px 5px 3px forestgreen !important;
        }

        .not-valid {
            box-shadow: none !important;
            box-shadow: 0px 0px 5px 3px darkred !important;
            color: red;
            text-shadow: 10px;
        }


        /*
        input[type="text"]{
            border: 0px;
            border-radius: 0px;
            border-bottom: 1px black solid;
        }
*/

        /*
        
        #txtUid{
            background-image: url(pics/user-regular.png);
            background-position: left;
            background-size:contain;
            padding-left: 50px;
        }
*/

        /*        both works fine*/
        #loginbtnspecific {
            background-color: #16c3b2;
            border: #16c3b2;
        }

        #loginbtnspecific:hover {
            background-color: #119d8f;
            font-family: lemon milk bold;
        }

    </style>
    <script>
        $(document).ready(function() {
            $uidDefaultMsg = "Your username must be 3-25 characters long, no spaces at ends, can include any character except '&'";
            $pwdDefaultMsg = "Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only";
            $("#txtUid").blur(function() {
                var uid = $(this).val();
                $(this).val(uid.trim()); //removes spaces left and right of sentence
            });
            $("#btnSignup").click(function() {
                var uid = $("#txtUid").val();
                var pwd = $("#txtPwd").val();
                var mob = $("#txtMob").val();

                //checking valid uid

                var resultUid = false;
                if (uid.length > 25 || uid.length < 3 || uid.indexOf('&') != -1) {
                    $("#txtUid").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                } else {
                    $("#txtUid").hide().css("box-shadow", "").show();
                    resultUid = true;
                }

                //checking valid password(pwd)
                var r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/; //without &
                var resultPwd = r.test(pwd);
                if (resultPwd == true) {
                    $("#txtPwd").hide().css("box-shadow", "").show();
                } else {
                    $("#txtPwd").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                }

                //checking valid mobile no.(mob)
                r = /^[6-9]{1}[0-9]{9}$/; //reg. expression
                var resultMob = r.test(mob);
                if (resultMob == true) {
                    $("#txtMob").hide().css("box-shadow", "").show();
                    //                    $("#txtMob").removeClass(".not-valid").addClass(".valid");
                } else {
                    //                    $("#txtMob").removeClass(".valid").addClass(".not-valid");
                    $("#txtMob").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                }

                var category = "";
                if ($("#radDoc").prop("checked") == true)
                    category = $("#radDoc").val();
                else
                    category = $("#radPat").val();

                var url = "";
                if (resultUid && resultPwd && resultMob) //i.e. true
                {
                    url = "signup.php?uid=" + uid + "&pwd=" + pwd + "&mob=" + mob + "&category=" + category;
                } else {
                    $("#errResultSignup").hide().html("Fill valid details").slideDown();
                    return;
                }
                $.get(url, function(response) {
                    $("#errResultSignup").hide().html(response).slideDown();
                });
            });

            $("#btnLogin").click(function() {
                var uid = $("#txtUidLogin").val();
                var pwd = $("#txtPwdLogin").val();
                var url = "login.php?uid=" + uid + "&pwd=" + pwd;
                $.getJSON(url, function(jsonArray) {
                    //                                        alert(JSON.stringify(jsonArray));
                    if (jsonArray == "Invalid username/password") { //for both uid not registered + pwd invalid
                        $("#errResultLogin").hide().html("Invalid username/password").slideDown();
                    } else {
                        if (jsonArray == "patient")
                            location.href = "dashboard-patient.php";
                        else
                            location.href = "doctor.php";
                        //session takes care of it (not required anymore...since we'll be redirected to dashboard)
                        //                        $("#txtPwdLogin").val("");
                        //                        $("#errResultLogin").html("");
                    }
                });
            });

            var temp_otp = NaN;
            var temp_uid = NaN;
            //remember temp_uid,otp resets everytime forgot modal is started
            //otp-modal, newpwd-modal execute only after forgot-modal
            $("#btnForgot").click(function() {
                var uid = $("#txtUidForgot").val();

                uid = uid.trim();
                if (uid.length > 25 || uid.length < 3 || uid.indexOf('&') != -1) {
                    $("#errResultForgot").html("Enter a valid username");
                    return;
                }
                var url = "forgot-process.php?uid=" + uid;
                $.get(url, function(response) {
                    if (response != "unauthorized") {
                        //                        temp_otp = response;
                        temp_otp = response.trim();
                        //                        alert(temp_otp);for testing purpose only
                        temp_uid = uid;
                    } else {
                        temp_otp = NaN;
                        temp_uid = NaN;
                    }
                    alert("OTP sent");
                    //resetting forgot modal
                    $("#txtUidForgot").val("");
                    $("#errResultForgot").html("");
                    $("#forgot-modal").modal("hide");

                    //resetting otp modal
                    $("#otp-modal").modal("show");
                    $("#txtOtp").val("");
                    $("#errResultOtp").html("");

                    //resetting newpwd modal
                    $("#txtNewPwd").val("");
                    $("#txtConfirmPwd").val("");
                    $("#errResultNewPwd").html("");
                });
            });

            $("#btnOtp").click(function() {
                var userOTP = $("#txtOtp").val();
                if (isNaN(temp_otp)) { //not a valid user
                    $("#errResultOtp").html("Wrong OTP");
                } else if (userOTP == temp_otp) {
                    //                    temp_otp = NaN;not required
                    //                    $("#errResultOtp").html("");not required 

                    $("#otp-modal").modal("hide");
                    $("#newpwd-modal").modal("show");
                    //                    $("#txtNewPwd").val("");not required
                    //                    $("#txtConfirmPwd").val("");not required
                    //                    $("#errResultNewPwd").html("");not required
                } else
                    $("#errResultOtp").html("Wrong OTP");
            });
            $("#btnConfirmPwd").click(function() {
                var r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/; //without &
                var newpwd = $("#txtNewPwd").val();
                var confirmpwd = $("#txtConfirmPwd").val();
                var result = r.test(newpwd);

                if (result && newpwd == confirmpwd) {
                    var url = "forgot-update-password.php?uid=" + temp_uid + "&pwd=" + newpwd;
                    $.get(url, function(response) {
                        if (response == "updated")
                            $("#errResultNewPwd").html("Updation Successfull !!!");
                        else
                            alert(response);
                    })
                    //                    temp_uid = NaN;not required

                } else if (result == false) {
                    $("#errResultNewPwd").html("Enter a valid password");
                } else
                    $("#errResultNewPwd").html("Password fields do not match");
            });
        });

    </script>
</head>

<body>
    <!--   facebook code 1-->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0" nonce="ucnhwxD5"></script>
    <!--   navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#f7f7f7;">
        <!--       16c3b2-->
        <a class="navbar-brand" href="index.php">
            <img src="pics/logo.png" style="height:90px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                -->
            </ul>
            <div class="btn btn-primary mr-2" data-toggle="modal" data-target="#login-modal" id="loginbtnspecific">Login</div>
            <!--            <div class="btn btn-primary mr-2" style="background-color: #16c3b2;border:#16c3b2;" data-toggle="modal" data-target="#login-modal" id="loginbtnspecific">Login</div>-->
            <div class="btn btn-outline-info mr-2" data-toggle="modal" data-target="#signup-modal">Signup</div>
            <div class="btn btn-link" data-toggle="modal" data-target="#forgot-modal">Forgot Password?</div>
        </div>
    </nav>

    <br>
    <br>
    <br>
    <br>
    <!--    carousel-->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="pics/bg_facilites2.jpg" class="d-block w-100" alt="..." style="height:550px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Health Records</h5>
                    <p>Maintain Doctor Appointment slips, Blood Pressure, Sugar Level records</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/access_record.jpg" class="d-block w-100" alt="..." style="height:550px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color: black;
  -webkit-text-fill-color: white;
  -webkit-text-stroke-width: 1px;
  -webkit-text-stroke-color: black;">Authenticated Access</h5>
                    <p style="color: black;
  -webkit-text-fill-color: black;
  -webkit-text-stroke-width: 1px;
  -webkit-text-stroke-color: black;">Access records securely on any device with filters</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="pics/doctor_search2.jpg" class="d-block w-100" alt="..." style="height:550px;">
                <div class="carousel-caption d-none d-md-block" style="color: black;
  -webkit-text-fill-color: black;
  -webkit-text-stroke-width: 1px;
  -webkit-text-stroke-color: black;">
                    <h5>Doctor Nearby</h5>
                    <p>Check Doctor Availability in any region all over India</p>
                </div>
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
    <!--    Services-->
    <div class="container col-md-12">
        <div class="row" style="background-color: #f7f7f7;">
            <div class="col-md-12 mt-2" style="height:60px;font-family:Arial Black; color:#b7b7b7">
                <center>
                    <h1>OUR SERVICES</h1>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="float: left;border:none;">
                    <!--                <div class="card" style="width: 300px; margin-left: 30px; float: left">-->
                    <img src="pics/lock-solid.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">S.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--    Developers-->
    <div class="container col-md-12">
        <div class="row" style="background-color: #f7f7f7;">
            <div class="col-md-12 mt-2" style="height:60px;font-family:Arial Black; color:#b7b7b7">
                <center>
                    <h1>DEVELOPERS</h1>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="float: left;border:none;">
                    <!--                <div class="card" style="width: 300px; margin-left: 30px; float: left">-->
                    <img src="pics/lock-solid.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">S.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--    Reach Us-->
    <div class="container col-md-12">
        <div class="row" style="background-color: #f7f7f7;">
            <div class="col-md-12 mt-2" style="height:100px;font-family:Arial Black; color:#b7b7b7">
                <center>
                    <h1>REACH US</h1>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13792.834960925027!2d74.9314127222578!3d30.20258920919828!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a28db31497%3A0xd5608f2fa15e1ad8!2ssirki%20bazar%2C%20Bathinda%2C%20Punjab!5e0!3m2!1sen!2sin!4v1595719677357!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
    <!--   facebook code 2-->
    <div class="fb-page" data-href="https://www.facebook.com/WHO" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
        <blockquote cite="https://www.facebook.com/WHO" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/WHO">World Health Organization (WHO)</a></blockquote>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!--    signup-modal-->
    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Signup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   signup form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtUid">Username</label>
                                    <input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="username">
                                    <small id="errUid" class="form-text text-muted">
                                        Your username must be 3-25 characters long, no spaces at ends, can include any character except &#39;&amp;&#39;
                                    </small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtPwd">Password</label>
                                    <input type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="password">
                                    <small id="errPwd" class="form-text text-muted">
                                        Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtMob" class="col-form-label">Mobile</label>

                                    <div class="input-group" style="">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+91</span>
                                        </div>
                                        <input type="text" class="form-control" id="txtMob" name="txtMob" placeholder="mobile no.">
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                Category
                                <div class="form-check form-check-inline ml-4">
                                    <input class="form-check-input" type="radio" name="radCategory" id="radDoc" value="doctor" checked>
                                    <label class="form-check-label" for="radDoc">Doctor</label>

                                </div>
                                <div class="form-check form-check-inline ml-4">
                                    <input class="form-check-input" type="radio" name="radCategory" id="radPat" value="patient">
                                    <label class="form-check-label" for="radPat">Patient</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <!--                    <button type="button" class="btn btn-primary form-control">Signup</button>-->
                    <input type="button" class="btn btn-primary form-control" value="Signup" id="btnSignup">
                    <span id="errResultSignup" class="text-danger"></span>
                </div>
            </div>
        </div>
    </div>
    <!--    login-modal-->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   login form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtUidLogin">Username</label>
                                    <input type="text" class="form-control" id="txtUidLogin" name="txtUidLogin" placeholder="username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="txtPwdLogin">Password</label>
                                    <input type="password" class="form-control" id="txtPwdLogin" name="txtPwdLogin" placeholder="password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="padding-bottom:10px;">
                    <div class="modal-footer justify-content-center">
                        <input type="button" class="btn btn-success" value="Login" id="btnLogin">
                        <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                    </div>
                    <center><span id="errResultLogin" class="text-danger"></span></center>
                </div>

            </div>
        </div>
    </div>
    <!--    forgot modal-->
    <div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recover Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   forgot form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <label for="txtUidForgot" class="col-form-label">Registered Username</label>
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" id="txtUidForgot" name="txtUidForgot" placeholder="username">
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-outline-info form-control" value="->" id="btnForgot">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <center><span id="errResultForgot" class="text-danger"></span></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    otp modal-->
    <div class="modal fade" id="otp-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   otp form-->
                    <form>
                        <div class="container">
                            <label for="txtOtp" class="col-form-label">OTP</label>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" id="txtOtp" name="txtOtp" placeholder="123456">
                                    <small id="errOTP" class="form-text text-muted">
                                        If you are our valid user, you'll receive a 6 digit OTP on registered number
                                    </small>
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-outline-info form-control" value="->" id="btnOtp">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <center><span id="errResultOtp" class="text-danger"></span></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    new password modal-->
    <div class="modal fade" id="newpwd-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   new password  form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <label for="txtNewPwd" class="col-form-label">New Password</label>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" id="txtNewPwd" name="txtNewPwd" placeholder="">
                                    <small id="errNewPwd" class="form-text text-muted">
                                        Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="txtConfirmPwd" class="col-form-label">Confirm Password</label>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" id="txtConfirmPwd" name="txtConfirmPwd" placeholder="">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <input type="button" class="btn btn-danger" value="Confirm" id="btnConfirmPwd">
                        <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                    </div>
                    <center><span id="errResultNewPwd" class="text-danger"></span></center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!--Readme-->

<!--signup modal
signup modal         ->id=signup-modal
uid textbox          -> id=txtUid ,name =txtUid, small ki id=errUid
password textbox     -> id=txtPwd ,name =txtPwd , small ki id=errPwd
mobile textbox       -> id=txtMob ,name =txtMob
doctor radio         -> id=radDoc , name=radCategory, value=doctor
patient radio        -> id=radPat , name=radCategory, value=patient
signup button        -> id=btnSignup, value=Signup, type=button, span ki id=errResultSignup
-->
<!--login modal
login modal          ->id=login-modal
uid textbox          -> id=txtUidLogin ,name =txtUidLogin
password textbox     -> id=txtPwdLogin ,name =txtPwdLogin
Login button         -> id=btnLogin, value=Login, type=button, span ki id=errResultLogin
-->
<!--unused regex

username
//                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/; //single space between words
//                var r = /^[a-zA-Z ]*$/;
password
//                r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;

-->
