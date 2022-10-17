<?php
session_start();
require "database.php";
if (isset($_POST["massage"])) {
    $mas = $_POST["massage"];
    if ($mas != "") {
        $us = $_POST["us"];

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");




        $res = database::s("SELECT * FROM `chat` WHERE (`to`='" . $_SESSION["admin"]["email"] . "' AND `from`='" . $us . "' ) OR (`to`='" . $us . "' AND `from`='" . $_SESSION["admin"]["email"] . "' );");
        $num = $res->num_rows;
        if ($num >= 1) {
            $r = $res->fetch_assoc();
            $chat_id = $r["chat_id"];
        } else {
            $chat_id = uniqid();
        }
        // echo $chat_id;

        database::iud("INSERT INTO `chat` (`chat_id`,`from`,`to`,`content`,`date`) VALUES ('" . $chat_id . "','" . $_SESSION["admin"]["email"] . "','" . $us . "','" . $mas . "','" . $date . "');");
    }
}
