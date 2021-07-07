<?php

include_once("connection.php");
$btn=$_POST["btn"];
if($btn=="Submit")
    { 
        doSubmit($dbcon);
    }
    else
    if($btn=="Update")
    {
        doUpdate($dbcon);
    }
        

function doUpdate($dbcon)
{
    $uid=$_POST["txtUid"];
$name=$_POST["txtName"];
$gender=$_POST["txtGender"];
$age=$_POST["txtAge"];
$address=$_POST["txtAddress"];
$city=$_POST["txtCity"];
$email=$_POST["txtEmail"];
$contact=$_POST["txtContact"];
$problems=$_POST["txtProblems"];

$query="update patients set name='$name',gender='$gender',age='$age',address='$address',city='$city',email='$email',contact='$contact',problems='$problems' where uid='$uid'";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
echo "SUCCESSFULLY UPDATED";
else
    echo $msg;
}


function doSubmit($dbcon)
{
    $uid=$_POST["txtUid"];
$name=$_POST["txtName"];
$gender=$_POST["txtGender"];
$age=$_POST["txtAge"];
$address=$_POST["txtAddress"];
$city=$_POST["txtCity"];
$email=$_POST["txtEmail"];
$contact=$_POST["txtContact"];
$problems=$_POST["txtProblems"];

$query="insert into patients values('$uid','$name','$gender','$age','$address','$city','$email','$contact','$problems')";
mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
echo "SUCCESSFULLY SUBMITTED";
else
    echo $msg;
}
?>