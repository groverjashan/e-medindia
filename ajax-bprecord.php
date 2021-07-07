<?php
include_once("connection.php");

$uid=$_GET["uid"];
$dor=$_GET["dor"];
$dia=$_GET["dia"];
$syst=$_GET["syst"];
$pulse=$_GET["pulse"];

$query="insert into bprecords values('$uid','$pulse','$dor','$dia','$syst')";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Submitted";
else
    echo $msg;
?>
