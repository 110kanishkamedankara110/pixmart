<?php
session_start();

require "database.php";

if (isset($_SESSION["user"])){
$mail = $_SESSION["user"]["email"];
$id = $_POST["i"];
$txt = $_POST["ft"];

// echo $id;
// echo $txt;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

database::iud("INSERT INTO `feedback` (`user_email`,`product_id`,`feed`,`date`)VALUES('".$mail."','".$id."','".$txt."','".$date."')");
echo "1";
}






?>