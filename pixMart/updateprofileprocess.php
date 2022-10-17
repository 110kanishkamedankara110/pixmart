<?php
require "database.php";
session_start();
if (isset($_SESSION["user"])) {
    if (isset($_FILES["img"])) {
        $img = $_FILES["img"];
    }

    // $img = $_FILES["img"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $addressline1 = $_POST["addressline1"];
    $addressline2 = $_POST["addressline2"];
    $city = $_POST["city"];
    if (empty($addressline2)) {
        $line2 = "NULL";
    } else {
        $line2 = $addressline2;
    }

    // echo $img." ".$fname." ".$lname." ".$email." ".$mobile." ".$addressline1." ".$addressline2." ".$city;
    if (empty($mobile)) {
        echo "Enter Your Mobile";
    } elseif (strlen($mobile) != 10) {
        echo "Inavlid Mobile";
    } elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile)) {
        echo "Invalid Mobile";
    } elseif (empty($fname)) {
        echo "Enter Your First Name";
    } elseif (empty($lname)) {
        echo "Enter Your Last Name";
    } elseif (empty($addressline1)) {
        echo "Enter Your Address Line 1 ";
    } elseif ($city == "Select City") {
        echo "Select Your City";
    } else {
        if (isset($img)) {
            $loc = "userprofileimg//" . uniqid() . $img["name"];
            move_uploaded_file($img["tmp_name"], $loc);
            if ($_SESSION["user"]["image"] != "NULL") {
                unlink($_SESSION["user"]["image"]);
            }
            database::iud("UPDATE user SET `first_name`='" . $fname . "',`last_name`='" . $lname . "',`mobile`='" . $mobile . "',`image`='" . $loc . "' WHERE `email`='" . $email . "'  ; ");
        } else {
            database::iud("UPDATE user SET `first_name`='" . $fname . "',`last_name`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $email . "'  ; ");
        }

        $address = database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $email . "'; ");
        $location = database::s("SELECT `location`.`id` AS `locid` FROM `location` INNER JOIN `city` ON `location`.`city_id`=`city`.`id` WHERE `city`.`name`='" . $city . "'; ");
        $locid = $location->fetch_assoc();
        $nr = $address->num_rows;

        if ($nr == 1) {
            database::iud("UPDATE `user_has_address` SET `line1`='" . $addressline1 . "',`line2`='" . $line2 . "',`location_id`='" . $locid["locid"] . "' WHERE `user_email`='" . $email . "' ; ");
        } else {
            database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`location_id`) VALUES ('" . $email . "','" . $addressline1 . "','" . $line2 . "','" . $locid["locid"] . "');");
        }

        $rs = database::s("SELECT * FROM user WHERE `email`='" . $email . "' ;");
        $n = $rs->num_rows;
        if ($n == 1) {
            $user = $rs->fetch_assoc();
            $_SESSION["user"] = $user;
        }
        echo "sucess";
    }
}
