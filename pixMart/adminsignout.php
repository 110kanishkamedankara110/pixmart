<?php

session_start();
unset($_SESSION["admin"]);

header("location:adminsignin.php");


?>