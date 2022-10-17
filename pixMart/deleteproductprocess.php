<?php
$pro=$_POST["product"];

require "database.php";

$result=database::s("SELECT * FROM `images` WHERE `product_id`='".$pro."' ");
$nr=$result->num_rows;
if($nr>=1){
    for($i=0;$i<$nr;$i++){
        $row=$result->fetch_assoc();
        unlink($row["code"]);
        database::iud("DELETE FROM `images` WHERE `product_id`='".$pro."';");
    }
    
}
database::iud("DELETE FROM `product` WHERE `id`='".$pro."';");
echo "Sucess";


?>