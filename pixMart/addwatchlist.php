<?php
session_start();
require "database.php";
$id=$_POST["id"];
$user=$_SESSION["user"]["email"];

    $res=database::s("SELECT * FROM `watchlist` WHERE `user_email`='".$user."' AND `product_id`='".$id."' ");
    $nr=$res->num_rows;
    if($nr>=1){
        database::iud("DELETE FROM `watchlist` WHERE `user_email`='".$user."' AND `product_id`='".$id."' ");
        echo"poe";
    }else{








    database::iud("INSERT INTO `watchlist` (`user_email`,`product_id`) VALUES('".$user."','".$id."'); ");
    echo "Sucess";
    }
