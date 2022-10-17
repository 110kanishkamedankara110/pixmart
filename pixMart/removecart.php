<?php
require "database.php";

$id=$_POST["id"];
database::iud("DELETE FROM `cart` WHERE `id`='".$id."';");

?>