<?php
require "database.php";
$id=$_POST["product"];
$status=$_POST["status"];
if($status==1){
    $st="2";
}else{
    $st="1";
}

database::iud("UPDATE `product`SET  `status_id`='".$st."' WHERE `id`='".$id."'; ");
if($st=="2"){
    echo("Product Deactivated");
    database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$id."' ;");
    database::iud("DELETE FROM `cart` WHERE `product_id`='".$id."' ;");
}else{
    echo("Product Activated");
}





?>