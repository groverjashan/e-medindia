<?php
include_once("connection.php");
$uid=$_GET["uid"];
$query="select * from doctors where uid='$uid'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>
