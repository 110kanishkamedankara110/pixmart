<?php
session_start();
if(isset($_SESSION["user"])){

$id=$_POST["id"];
$qty=$_POST["qty"];
require "database.php";
$array;
$user=$_SESSION["user"]["email"];
$orderID=uniqid();
$products=database::s("SELECT * FROM `product` WHERE `id`='".$id."'  ;");
$pr=$products->fetch_assoc();
$userad=database::s("SELECT * FROM `user_has_address` WHERE `user_email` ='".$user."';  ");

$nnr=$userad->num_rows;

if($nnr>=1){
    $city=$userad->fetch_assoc();

    $item=$pr["title"];
    
    if($city["location_id"]=="9"){
        $shipping=$pr["delivery_fee_colombo"];
    }else{
        $shipping=$pr["delivery_fee_other"];
    }
    $amount=$pr["price"]*$qty +$shipping;
    $first_name=$_SESSION["user"]["first_name"];
    $last_name=$_SESSION["user"]["last_name"];
    $email=$user;
    $mobile=$_SESSION["user"]["mobile"];
    $address=$city["line1"]." ".$city["line2"];
    
    
    $cityname=database::s("SELECT * FROM `location` 
    INNER JOIN `city` ON `location`.`city_id`=`city`.`id` WHERE `location`.`id`='".$city["location_id"]."';");
    
    $ci=$cityname->fetch_assoc();
    $usercity=$ci["name"];
    
    echo "{".'"orderID"'.":".'"'.$orderID.'"'.","
        .'"item"'.":".'"'.$item.'"'.","
        .'"amount"'.":".'"'.$amount.'"'.","
        .'"qty"'.":".'"'.$qty.'"'.","
        .'"first_name"'.":".'"'.$first_name.'"'.","
        .'"last_name"'.":".'"'.$last_name.'"'.","
        .'"email"'.":".'"'.$email.'"'.","
        .'"phone"'.":".'"'.$mobile.'"'.","
        .'"city"'.":".'"'.$usercity.'"'.","
        .'"address"'.":".'"'.$address.'"'."}";
    

}else{
    echo "2";
}










}else{
    


echo "1";


}
?>
