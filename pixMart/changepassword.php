<?php
require "database.php";

$email=$_POST["email"];
$password1=$_POST["mp"];
$password2=$_POST["mp2"];
$veryfy=$_POST["vc"];



if(empty($email)){
    echo"Email Cannot Found";
}elseif(empty($veryfy)){
    echo"Enter Your Verification Code";
}
elseif(empty($password1)){
    echo"Enter Your Password";
}elseif(strlen($password1) <2 || strlen($password)>20){
    echo"Invalid Password";
}elseif(empty($password2)){
    echo"Retype Your Password";
}elseif($password1!=$password2){
    echo"Password Doesn't match";
}else{
    $res=database::s("SELECT * FROM user WHERE `email`='".$email."' && `verification_code`='".$veryfy."'; ");
    $nr=$res->num_rows;
    if($nr==1){
        database::s("UPDATE user SET `password`='".$password1."' WHERE `email`='".$email."' ;");
        echo"Sucess";
    }else{
        echo"Verification Failed";
    }
}




?>