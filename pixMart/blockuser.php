<?php
$email=$_POST["email"];
require "database.php";

$user=database::s("SELECT * FROM `user` WHERE `email`='".$email."';");
$ur=$user->fetch_assoc();
if($ur["status"]=="1"){
    database::iud("UPDATE `user` SET `status`='2' WHERE `email`='".$email."' ;");
    database::iud("UPDATE `product` SET `status_id`='2' WHERE `user_email`='".$email."' ;");
    echo "blocked";
}else{
    database::iud("UPDATE `user` SET `status`='1' WHERE `email`='".$email."' ;");
    database::iud("UPDATE `product` SET `status_id`='1' WHERE `user_email`='".$email."' ;");
    echo "unblocked";
}

?>