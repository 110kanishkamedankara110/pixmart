<?php
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$password=$_POST["password"];
$mobile=$_POST["mobile"];
$gender=$_POST["gender"];

if(empty($fname)){
    echo"Enter Your First Name";
}elseif(strlen($fname)>50){
    echo"Invalid First Name";
}elseif(empty($lname)){
    echo"Enter Your Last Name";
}elseif(strlen($lname)>50){
    echo"Invalid First Name";
}elseif(empty($email)){
    echo"Enter Your email";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo"Invalid Email";
}elseif(strlen($email)>50){
    echo"Invalid Email";
}elseif(empty($password)){
    echo"Enter Your Password";
}elseif(strlen($password) <2 || strlen($password)>20){
    echo"Invalid Password";
}elseif(empty($mobile)){
    echo"Enter Your Mobile";
}
elseif(strlen($mobile)!=10){
    echo"Inavlid Mobile";
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile)){
    echo"Invalid Mobile";
}else{
    require "database.php";
    $res=database::s("SELECT * FROM user Where `email`='".$email."'; ");
    if($res->num_rows>0){
        echo "Sorry User Alredy Registered";
    }else{
    $date=date("Y-m-d H:i:s");
    
    // echo $gender;
    
    database::iud("INSERT INTO `user` VALUES('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$date."','1','".$gender."','NULL','NULL');");
    echo"Sucess";
    }
}

?>