<?php
include_once("connection.php");
$patientuid=$_POST["txtUid"];
$doctorname=$_POST["txtDname"];
$dovisit=$_POST["txtDov"];
$city=$_POST["txtCity"];
$hospital=$_POST["txtHospital"];
$problem=$_POST["txtProblem"];
$nextdov=$_POST["txtNextdov"];
$discussion=$_POST["txtDiscussion"];
$slippic=$_FILES["slipPic"]["name"];
$temp=$_FILES["slipPic"]["tmp_name"];

move_uploaded_file($temp,"uploads/".$slippic);
$query="insert into slips values(null,'$patientuid','$doctorname','$dovisit','$city','$hospital','$problem','$nextdov','$discussion','$slippic')";

mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "SLIP DATA SENT";
else
    echo $msg;
?>