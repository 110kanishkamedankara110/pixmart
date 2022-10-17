<?php
session_start();

require "database.php";

$id=$_POST["id"];
$qty=$_POST["qty"];
$user=$_SESSION["user"]["email"];

$cp=database::s("SELECT * FROM `cart` WHERE  `product_id`='".$id."' AND `user_email`='".$user."'; ");
$nr=$cp->num_rows;
if($nr==1){
    echo "Product Alredy Added";
}else{
    database::iud("INSERT INTO `cart` (`qty`,`product_id`,`user_email`)  VALUES ('".$qty."','".$id."','".$user."')   ;");
    echo "Sucess";
    
}



?>