<?php
include_once("connection.php");
include_once("SMS_OK_sms.php");
$uid=$_GET["uid"];
$query="select * from users where uid='$uid'";
$table=mysqli_query($dbcon,$query);

if(mysqli_num_rows($table)==0)
    echo "No user exist with this Uid";
else
    {
    $row=mysqli_fetch_array($table);
        $resp=SendSMS($row["mobile"],"Password :- ".$row["pwd"]);
        echo "Sent to your registered number.<br>".$resp;
    }
?>