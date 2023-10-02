<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="";
$dbName="login_registor";
$con = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$con){
    die("Somethinf went wrong");
}
?>