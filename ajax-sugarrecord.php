<?php
include_once("connection.php");

$uid=$_GET["uid"];
$dor=$_GET["dor"];
$tor=$_GET["tor"];
$sugartime=$_GET["sugartime"];
$sugarresult=$_GET["sugarresult"];
$medintake=$_GET["medintake"];
$urineresult=$_GET["urineresult"];

$query="insert into sugarrecord values('$uid','$dor','$tor','$sugartime','$sugarresult','$medintake','$urineresult')";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "Submitted";
else
    echo $msg;
?>
