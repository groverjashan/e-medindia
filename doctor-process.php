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
$dname=$_POST["txtDname"];
$contact=$_POST["txtContact"];
$spl=$_POST["txtSpl"];
$qual=$_POST["txtQual"];
$studied=$_POST["txtStudied"];
$exp=$_POST["txtExp"];
$hospital=$_POST["txtHospital"];
$address=$_POST["txtAddress"];
$city=$_POST["txtCity"];
$email=$_POST["txtEmail"];
$website=$_POST["txtWebsite"];
$ppic=$_FILES["profilePic"]["name"];
$ptemp=$_FILES["profilePic"]["tmp_name"];
$cpic=$_FILES["certiPic"]["name"];
$ctemp=$_FILES["certiPic"]["tmp_name"];
$info=$_POST["txtInfo"];


    $jasus1=$_POST["jasus1"];
    $jasus2=$_POST["jasus2"];
    if($ppic=="")
    {
        $filename1=$jasus1;
    }
    else
    {
        $filename1=$ppic;
        move_uploaded_file($ptemp,"uploads/".$ppic);
    }
    if($cpic=="")
    {
        $filename2=$jasus2;
    }
    else
    {
        $filename2=$cpic;
        move_uploaded_file($ctemp,"uploads/".$cpic);
    }
    
$query="update doctors set dname='$dname',contact='$contact',spl='$spl',qual='$qual',studied='$studied',exp='$exp',hospital='$hospital',address='$address',city='$city',email='$email',website='$website',ppic='$filename1',cpic='$filename2',info='$info' where uid='$uid'";

mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "PROFILE UPDATED";
else
    echo $msg;
}
function doSubmit($dbcon)
{
    $uid=$_POST["txtUid"];
$dname=$_POST["txtDname"];
$contact=$_POST["txtContact"];
$spl=$_POST["txtSpl"];
$qual=$_POST["txtQual"];
$studied=$_POST["txtStudied"];
$exp=$_POST["txtExp"];
$hospital=$_POST["txtHospital"];
$address=$_POST["txtAddress"];
$city=$_POST["txtCity"];
$email=$_POST["txtEmail"];
$website=$_POST["txtWebsite"];
$ppic=$_FILES["profilePic"]["name"];
$ptemp=$_FILES["profilePic"]["tmp_name"];
$cpic=$_FILES["certiPic"]["name"];
$ctemp=$_FILES["certiPic"]["tmp_name"];
$info=$_POST["txtInfo"];

move_uploaded_file($ptemp,"uploads/".$ppic);
move_uploaded_file($ctemp,"uploads/".$cpic);
$query="insert into doctors values('$uid','$dname','$contact','$spl','$qual','$studied','$exp','$hospital','$address','$city','$email','$website','$ppic','$cpic','$info')";

mysqli_query($dbcon,$query);
$msg=mysqli_error($dbcon);
if($msg=="")
    echo "PROFILE COMPLETED";
else
    echo $msg;
}


?>