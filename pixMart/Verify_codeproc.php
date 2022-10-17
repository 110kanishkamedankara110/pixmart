<?php
session_start();
require "database.php";
if(isset($_POST["vcode"])){
    $vcode = $_POST["vcode"];
$adminrs = database::s("SELECT * FROM `admin` WHERE `verification` = '".$vcode."'");
$an = $adminrs->num_rows;

if($an==1){
$ar = $adminrs->fetch_assoc();
$_SESSION["admin"] = $ar;


echo "success";

}else{
    echo "Invalid Verification Code";
}

}else {
    echo "Please Enter Verification code";
}



?>