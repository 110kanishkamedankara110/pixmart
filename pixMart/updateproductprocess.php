<?php
session_start();
$id= $_POST["search"];
if(intval($id)){
    require "database.php";
    $result=database::s("SELECT `product`.`id`,`category`.`name` 
    AS `catagory`,`brand`.`name` 
    AS `brand`,`model`.`name` 
    AS `model`,`title`,`condition`.`condition` 
    AS `condition`,`color`.`name` 
    AS `color`,`qty`,`price`,`delivery_fee_colombo`,`delivery_fee_other`,`description` 
    FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
    INNER JOIN `model_has_brand` ON `model_has_brand`.`id`=`product`.`model_has_brand_id1` 
    INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` 
    INNER JOIN `brand` ON `brand`.`id`=`model_has_brand`.`brand_id` 
    INNER JOIN `color` ON `color`.`id`=`product`.`color_id` 
    INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` WHERE product.`id`='".$id."' AND `user_email`='".$_SESSION["user"]["email"]."' ; ");
    $nr=$result->num_rows;
    if($nr==1){
        $product=$result->fetch_assoc();
        $res2=database::s("SELECT * FROM `images` WHERE `product_id`='".$id."';");

        $ni=$res2->num_rows;
        
        
        $catagory=$product["catagory"];
        $brand=$product["brand"];
        $model=$product["model"];
        $title=$product["title"];
        $condition=$product["condition"];
        $color=$product["color"];
        $qty=$product["qty"];
        $price=$product["price"];
        $dfc=$product["delivery_fee_colombo"];
        $dfo=$product["delivery_fee_other"];
        $description=$product["description"];
        $id=$product["id"];
        
        echo"{";

            for($x=0;$x<$ni;$x++){
                $image=$res2->fetch_assoc();
                $im="image".$x;
            echo '"'.$im.'"'.":".'"'.$image["code"].'"'.",";
            }


            echo '"catagory"'.":".'"'.$catagory.'"'.",";
            echo '"brand"'.":".'"'.$brand.'"'.",";
            echo '"model"'.":".'"'.$model.'"'.",";
            echo '"title"'.":".'"'.$title.'"'.",";
            echo '"condition"'.":".'"'.$condition.'"'.",";
            echo '"color"'.":".'"'.$color.'"'.",";
            echo '"qty"'.":".'"'.$qty.'"'.",";
            echo '"dfc"'.":".'"'.$dfc.'"'.",";
            echo '"dfo"'.":".'"'.$dfo.'"'.",";
            echo '"price"'.":".'"'.$price.'"'.",";
            echo '"id"'.":".'"'.$id.'"'.",";
            echo '"description"'.":".'"'.$description.'"';
            echo"}";   

            
        
    }else{
        echo "cannot fount product";
    }













}else{
    echo "invalid id";
}




?>