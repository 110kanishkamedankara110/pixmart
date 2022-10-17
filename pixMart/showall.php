<?php
session_start();
require "database.php";
$cat=$_POST["cat"];
$page = $_POST["page"];

$limit = 6;
$ofs = ($page * $limit) - $limit;

$products = database::s("SELECT `product`.`id`,`category_id`,`category`.`name` 
AS `catagory`,`brand`.`name` 
AS `brand`,`model`.`name` 
AS `model`,`title`,`condition`.`condition` 
AS `condition`,`color`.`name` 
AS `color`,`qty`,`price`,`delivery_fee_colombo`,`delivery_fee_other`,`description`,`first_name`,`last_name`,`email` 
FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
INNER JOIN `model_has_brand` ON `model_has_brand`.`id`=`product`.`model_has_brand_id1` 
INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` 
INNER JOIN `brand` ON `brand`.`id`=`model_has_brand`.`brand_id` 
INNER JOIN `color` ON `color`.`id`=`product`.`color_id` 
INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `category_id`='".$cat."' AND `status_id`!='2' LIMIT " . $limit . " OFFSET " . $ofs . " ;");

$productsno = database::s("SELECT `product`.`id`,`category`.`name` 
AS `catagory`,`brand`.`name` 
AS `brand`,`model`.`name` 
AS `model`,`title`,`condition`.`condition` 
AS `condition`,`color`.`name` 
AS `color`,`qty`,`price`,`delivery_fee_colombo`,`delivery_fee_other`,`description`,`first_name`,`last_name`,`email` 
FROM `product` INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
INNER JOIN `model_has_brand` ON `model_has_brand`.`id`=`product`.`model_has_brand_id1` 
INNER JOIN `model` ON `model_has_brand`.`model_id`=`model`.`id` 
INNER JOIN `brand` ON `brand`.`id`=`model_has_brand`.`brand_id` 
INNER JOIN `color` ON `color`.`id`=`product`.`color_id` 
INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `category_id`='".$cat."' AND `status_id`!='2' ;");

$pnr = $productsno->num_rows;
$nr = $products->num_rows;
$pages = ceil($pnr / $limit);

for ($i = 0; $i < $nr; $i++) {
    $pro = $products->fetch_assoc();
    $im = database::s("SELECT * FROM `images` WHERE `product_id`='" . $pro["id"] . "'; ");
    $imgpath = $im->fetch_assoc();
    if(isset($_SESSION["user"])){
    $wl = database::s("SELECT * FROM `watchlist`  WHERE `product_id`='" . $pro["id"] . "' AND `user_email`='" . $_SESSION["user"]["email"] . "' ;");
    $nwl = $wl->num_rows;
    }
?>
    <div class="d-inline-block col-5 col-lg-2  card mt-1 mb-1 ms-1" style="width: 18rem;">
        <img src="<?php echo $imgpath["code"]; ?>" class="card-img-top cardTopImg">
        <div class="card-body">
            <h5 class="card-title"><?php echo $pro["title"] ?></h5>
            <span class="card-text text-primary">Rs. <?php echo $pro["price"] ?> </span><br />
            <?php
           
            ?>
            <?php
            if ($pro["qty"] > 0) {
                $h="heart".$pro["id"]
            ?>
                <span class="card-text text-warning">In Stock</span><br />
                <input id="qty<?php echo $pro['id'] ?>" type="number" class="form-control mb-1" value="1" min="1" max="<?php echo $pro["qty"] ?>" />
                                                          
                <a href="singleproductview.php?id=<?php echo $pro["id"]; ?>" class="btn btn-success">Buy Now</a>
                <?php if(isset($_SESSION["user"])){
                ?>
                 <a  onclick="addtocart(<?php echo $pro['id'] ?>,<?php echo $pro['qty'] ?>);" class="btn btn-danger">Add To Cart</a>
                <?php
                }
                ?>
               
                <?php
                if(isset($_SESSION["user"])){
                    if ($nwl == 1) {
                        ?>
                            <a onclick="addwatchlist(<?php echo $pro['id'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart-fill"></i></a>
                        <?php
                        } else {
                        ?>
                            <a onclick="addwatchlist(<?php echo $pro['id'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart"></i></a>
                        <?php
                        }
                }
                
                ?>

                
            <?php
            } else {
            ?>
                <span class="card-text text-danger">Out Of Stock</span><br />

                <button disabled class="btn btn-success">Buy Now</button>
                
                <button disabled class="btn btn-danger">Add To Cart</button>
            <?php
            }
            ?>

        </div>
    </div>

<?php

}

?>
<div class="col-12 mb-3">
    <div class="row">

        <div class="pagination justify-content-center">
            <?php
            if ($page == 1) {
            ?>
                <a href="#" class="d-none">&laquo;</a>
            <?php
            } else {
            ?>
                <a onclick="pagin2(<?php echo $page - 1 ?>,<?php echo $cat?>)"><i class="bi bi-caret-left-fill"></i></a>
            <?php
            }
            ?>



            <?php
            for ($pn = 1; $pn <= $pages; $pn++) {
                if ($pn == $page) {
            ?>
                    <a onclick="pagin2(<?php echo $pn ?>,<?php echo $cat?>)" class="active"><?php echo $pn ?></a>
                <?php
                } else {
                ?>
                    <a onclick="pagin2(<?php echo $pn ?>,<?php echo $cat?>)"><?php echo $pn ?></a>

            <?php
                }
            }
            ?>

            <?php
            if ($page == $pages) {
            ?>
                <a href="#" class="d-none">&raquo;</a>
            <?php
            } else {
            ?>
                <a onclick="pagin2(<?php echo $page + 1 ?>,<?php echo $cat?>)"><i class="bi bi-caret-right-fill"></i></a>
            <?php
            }
            ?>

        </div>


    </div>
</div>