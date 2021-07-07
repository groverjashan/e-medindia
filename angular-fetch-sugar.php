<?php
include_once("connection.php");
$uid=$_GET["uid"];
$dfrom=$_GET["dfrom"];
$dto=$_GET["dto"];
$query="select * from sugarrecord where uid='$uid' and dateofrecord>='$dfrom' and dateofrecord<='$dto'";
$table=mysqli_query($dbcon,$query);
$ary=array();
while($row=mysqli_fetch_array($table))
{
    $ary[]=$row;
}
echo json_encode($ary);

?>
