<?php
require "database.php";
session_start();

$email=$_POST["email"];
$password=$_POST["password"];
$remember=$_POST["remember"];
$rs=database::s("SELECT * FROM user WHERE `email`='".$email."' AND `password`='".$password."' ");
$n=$rs->num_rows;
if($n==1){
    $user=$rs->fetch_assoc();
    if($user["status"]=="2"){
        echo "Sorry You Are Blocked By admins";
    }else{
        $_SESSION["user"]=$user;
        echo "Sucess";
        if($remember=="true"){
            setcookie("e",$email,time()+((60*60)*24));
            setcookie("p",$password,time()+((60*60)*24));
        }else{
            setcookie("e","",-1);
            setcookie("p","",-1);
        }
    }
    
}else{
    echo "Invalid details";
}
