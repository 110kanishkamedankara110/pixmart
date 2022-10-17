<?php
session_start();


$mail = $_SESSION["user"]["email"];

require "database.php";

if (isset($_SESSION["user"])) {

    $order_id = $_POST["order_id"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");

    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $cart = database::s("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ;");





    $userad = database::s("SELECT * FROM `user_has_address` WHERE `user_email` ='" . $mail . "';  ");
    $city = $userad->fetch_assoc();

    $cnr = $cart->num_rows;
    for ($i = 0; $i < $cnr; $i++) {



        $cp = $cart->fetch_assoc();
        $pro = database::s("SELECT * FROM `product` WHERE `id`='" . $cp["product_id"] . "' ; ");
        $product = $pro->fetch_assoc();

        if ($city["location_id"] == "9") {
            $ship = $product["delivery_fee_colombo"];
        } else {
            $ship = $product["delivery_fee_other"];
        }
    
        $qty=$cp["qty"];
        $amount=$ship + ($product["price"]*$qty);
        $newqty = $product["qty"] - $cp["qty"];
        database::iud("UPDATE `product` SET `qty`='" . $newqty . "' WHERE `id`='" . $cp["product_id"] . "' ;");
        database::iud("INSERT INTO `invoice` (`order_id`,`date`,`user_email`,`product_id`,`total`,`qty`)  VALUES ('" . $order_id . "','" . $date . "','" . $mail . "','" . $cp["product_id"] . "','" . $amount . "','" . $qty . "') ;");
    }
    database::iud("DELETE FROM `cart` WHERE `user_email`='".$_SESSION["user"]["email"]."' ;");
    echo "sucess";
}
