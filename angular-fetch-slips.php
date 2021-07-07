<?php
include_once("connection.php");
$uid=$_GET["uid"];
$dfrom=$_GET["dfrom"];
$dto=$_GET["dto"];
$query="select * from slips where patientuid='$uid' and dovisit>='$dfrom' and dovisit<='$dto'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>
