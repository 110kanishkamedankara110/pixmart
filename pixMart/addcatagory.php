<?php
$catagory=$_POST["catagory"];
require "database.php";

database::iud("INSERT INTO `category` (`name`) VALUES ('".$catagory."'); ");
echo "sucess";


?>