<?php
require "database.php";
session_start();
$from = $_POST["from"];
$to = $_POST["to"];
$ar = "";
$count=0;
unset($_SESSION["r"]);
unset($_SESSION["coun"]);
if (!empty($from) && empty($to)) {
    $invoic = database::s("SELECT DISTINCT (`order_id`),`date` FROM `invoice` ;");
    
    
    $in = $invoic->num_rows;
    for ($i = 0; $i < $in; $i++) {
        $ir = $invoic->fetch_assoc();
        $indate = $ir["date"];
        $splitdate = explode(" ", $indate);
        $date = $splitdate["0"];
        if ($from == $date) {
            $ar = $ar . "," . $ir["order_id"];
        }
    }
    $ic = database::s("SELECT * FROM `invoice` ;");
    
    
    $cou = $ic->num_rows;
    for ($i = 0; $i < $cou; $i++) {
        $ir = $ic->fetch_assoc();
        $indate = $ir["date"];
        $spl = explode(" ", $indate);
        $dat = $spl["0"];
        if ($from == $dat) {
            $count=$count+1;
        }
    }
    $_SESSION["r"] = $ar;
    $_SESSION["coun"] = $count;
} else if (!empty($from) && !empty($to)) {
    $invoic = database::s("SELECT DISTINCT (`order_id`),`date` FROM `invoice` ;");
    $in = $invoic->num_rows;
    for ($i = 0; $i < $in; $i++) {
        $ir = $invoic->fetch_assoc();
        $indate = $ir["date"];
        $splitdate = explode(" ", $indate);
        $date = $splitdate["0"];
        if ($from <= $date && $date <= $to) {
            $ar = $ar . "," . $ir["order_id"];
        }
    }

    $ic = database::s("SELECT * FROM `invoice` ;");
    
    
    $cou = $ic->num_rows;
    for ($i = 0; $i < $cou; $i++) {
        $ir = $ic->fetch_assoc();
        $indate = $ir["date"];
        $spl = explode(" ", $indate);
        $dat = $spl["0"];
        if ($from <= $dat && $dat <= $to) {
            $count=$count+1;
        }
    }

    $_SESSION["r"] = $ar;
    $_SESSION["coun"] = $count;
} else if (empty($from) && empty($to)) {
    $dt = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $dt->setTimezone($tz);
    $today = $dt->format("Y-m-d");

    $invoic = database::s("SELECT DISTINCT (`order_id`),`date` FROM `invoice` ;");
    $in = $invoic->num_rows;
    for ($i = 0; $i < $in; $i++) {
        $ir = $invoic->fetch_assoc();
        $indate = $ir["date"];
        $splitdate = explode(" ", $indate);
        $date = $splitdate["0"];
        if ($date == $today) {
            $ar = $ar . "," . $ir["order_id"];
        }
    }
    $ic = database::s("SELECT * FROM `invoice` ;");
    
    
    $cou = $ic->num_rows;
    for ($i = 0; $i < $cou; $i++) {
        $ir = $ic->fetch_assoc();
        $indate = $ir["date"];
        $spl = explode(" ", $indate);
        $dat = $spl["0"];
        if ($dat == $today) {
            $count=$count+1;
        }
    }




    $_SESSION["r"] = $ar;
    $_SESSION["coun"] = $count;
}

