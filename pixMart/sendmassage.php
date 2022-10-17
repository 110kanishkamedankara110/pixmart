<?php
session_start();
require "database.php";
if (isset($_POST["massage"])) {

    $mas = $_POST["massage"];
    if ($mas != "") {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");




        $res = database::s("SELECT * FROM `chat` WHERE (`to`='" . $_SESSION["user"]["email"] . "' AND `from`='" . $_SESSION["selctuser"] . "' ) OR (`to`='" . $_SESSION["selctuser"] . "' AND `from`='" . $_SESSION["user"]["email"] . "' );");
        $num = $res->num_rows;
        if ($num >= 1) {
            $r = $res->fetch_assoc();
            $chat_id = $r["chat_id"];
        } else {
            $chat_id = uniqid();
        }
        // echo $chat_id;

        database::iud("INSERT INTO `chat` (`chat_id`,`from`,`to`,`content`,`date`) VALUES ('" . $chat_id . "','" . $_SESSION["user"]["email"] . "','" . $_SESSION["selctuser"] . "','" . $mas . "','" . $date . "');");
    }
}
