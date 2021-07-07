<?php

include_once("connection.php");
include_once("SMS_OK_sms.php");
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];
$mobile=$_GET["mob"];
$category=$_GET["category"];
$query="insert into users values('$uid','$pwd','$mobile',current_date(),'$category')";
mysqli_query($dbcon,$query);

$msg=mysqli_error($dbcon);
if($msg=="")
    {
        $resp=SendSMS($mobile,"YOU ARE SUCCESSFULLY SIGNEDUP BRO...");
        echo "Signed Up Successfully.<br>".$resp;
    }
else
    echo $msg;
?>