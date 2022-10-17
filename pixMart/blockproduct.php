<?php
$id=$_POST["id"];
require "database.php";

$user=database::s("SELECT * FROM `product` WHERE `id`='".$id."';");
$ur=$user->fetch_assoc();
if($ur["status_id"]=="1"){
    database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='".$id."' ;");
    database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$id."' ;");
    database::iud("DELETE FROM `cart` WHERE `product_id`='".$id."' ;");
      echo "blocked";
}else{
    database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='".$id."' ;");
     echo "unblocked";
}

?>