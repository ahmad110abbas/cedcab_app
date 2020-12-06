<?php
include_once('config.php');

$username=new DB_con();

$uname= $_POST["username"]; 

$sql=$username->usernameavailblty($uname);
$num=mysqli_num_rows($sql);
if($num > 0)
{
echo "<span style='color:red'> Username exists.</span>";
echo "<script>$('#submit').prop('disabled',true);</script>";
} else{

echo "<span style='color:green'> Unsername available .</span>";
echo "<script>$('#submit').prop('disabled',false);</script>";
}?>