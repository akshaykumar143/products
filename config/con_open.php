<?php
$sname= "127.0.0.1";
$uname= "root";
$pass= "";
$db= "akshay_jul18";
$con = mysqli_connect($sname,$uname,$pass,$db);
if (!$con ){
   die("not connect : ". mysqli_connect_error());
}else{
   // echo "ok";die();
}
?>