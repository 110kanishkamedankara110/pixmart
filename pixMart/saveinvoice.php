<?php
session_start();


// echo $pro_id;
// echo $order_id;
// echo $qty;
// echo $mail;
// echo $amount;

require "database.php";

if(isset($_SESSION["user"])){
    $pro_id=$_POST["pro_id"];
    $order_id=$_POST["order_id"];
    $qty=$_POST["qty"];
    $mail=$_POST["mail"];
    $amount=$_POST["amount"];
    $d=new DateTime();
    $tz=new DateTimeZone("Asia/Colombo");

    $d->setTimezone($tz);
    $date=$d->format("Y-m-d H:i:s");

    $products=database::s("SELECT * FROM `product` WHERE `id`='".$pro_id."'");
    $pn=$products->fetch_assoc();

    $proqty=$pn["qty"];
    $newqty=$proqty-$qty;

    database::iud("UPDATE `product` SET `qty`='".$newqty."' WHERE `id`='".$pro_id."' ");
    database::iud("INSERT INTO `invoice` (`order_id`,`date`,`user_email`,`product_id`,`total`,`qty`)  VALUES ('".$order_id."','".$date."','".$mail."','".$pro_id."','".$amount."','".$qty."') ;");

echo "sucess";

}
?>