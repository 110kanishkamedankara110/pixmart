<?php
session_start();
require "database.php";
$key = $_POST["key"] . "%";


$cart = database::s("SELECT `cart`.id AS `cid`,`product`.`id` AS `pid`,`title`,`cart`.`user_email`,`product_id`,`cart`.`qty` AS `cqty` FROM `cart` INNER JOIN  `product` ON `product`.`id`=`cart`.`product_id` WHERE `cart`.`user_email`='" . $_SESSION["user"]["email"] . "' AND `title` LIKE '" . $key . "';");
$cpronr = $cart->num_rows;

// $totprice = 0;
// $totship = 0;
































?>
<?php
if ($cpronr == 0) {
?>
    <div class="col-12 ">
        <div class="row">
            <div class="col-12 emptycart"></div>
            <div class="col-12 text-center">
                <label class="form-label fs-1 fw-bolder">You Have no items in your basket.</label>
            </div>
            <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                <a href="home.php" class="btn btn-primary">Start Shopping</a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="col-11 col-lg-9">
        <div class="row">
            <?php
            for ($i = 0; $i < $cpronr; $i++) {
                $pro = $cart->fetch_assoc();
                $products = database::s("SELECT `product`.`id`,`product`.`category_id`,`category`.`name` 
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
                                INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` 
                                INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='" . $pro["pid"] . "'  ;");

                $wlpro = $products->fetch_assoc();
                $im = database::s("SELECT * FROM `images` WHERE `product_id`='" . $wlpro["id"] . "'; ");
                $imgpath = $im->fetch_assoc();
                $ul = database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["user"]["email"] . "';");
                $uadres = $ul->fetch_assoc();
                if ($uadres["location_id"] == '9') {
                    $shipping = $wlpro["delivery_fee_colombo"];
                } else {
                    $shipping = $wlpro["delivery_fee_other"];
                }
                // $totprice = $totprice + $wlpro["price"] * $pro["cqty"];
                // $totship = $totship + $shipping;
            ?>

                <div class="card mb-3  col-12">
                    <div class=" row g-0">
                        <div class="col-md-12 mt-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-bold text-black-50 fs-5">Seller : </span>
                                    <span class=" fs-5"><?php echo $wlpro["first_name"] . " " . $wlpro["last_name"] ?> </span>
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" onmouseover="pop(<?php echo $pro['product_id']; ?>)" onmouseout="pop2(<?php echo $pro['product_id']; ?>)">
                            <div class="pa col-lg-6 col-12">
                                <div class="tol rounded col-12 p-2 d-none" id="pop<?php echo $pro["product_id"]; ?>">
                                    <h3 class="text-white"><?php echo $wlpro["title"] ?></h3>
                                    <span class="text-white">Brand: <?php echo $wlpro["brand"] ?></span><br />
                                    <span class="text-white">Model: <?php echo $wlpro["model"] ?></span><br />
                                    <span class="text-white">Color: <?php echo $wlpro["color"] ?></span><br /><br />
                                    <span class="text-white"><?php echo $wlpro["description"] ?></span>
                                </div>
                            </div>
                            <img src="<?php echo $imgpath["code"] ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-5">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $wlpro["title"] ?></h3>
                                <span class="fw-bold text-black-50 " style="font-size: 12px;">Colour : <?php echo $wlpro["color"] ?> </span>&nbsp;
                                &nbsp; <span class="fw-bold text-black-50 " style="font-size: 12px;">Condition : <?php echo $wlpro["condition"] ?></span>
                                <br />
                                <span class="fw-bold text-black-50 fs-5">Price :</span> &nbsp;
                                &nbsp; <span class="fw-bold text-black">Rs. <?php echo $wlpro["price"] ?></span>
                                <br />
                                <span class="fw-bold text-black-50 fs-5">Quentity : </span>
                                <input disabled id="qty<?php echo $wlpro['id'] ?>" type="text" value="<?php echo $pro["cqty"] ?>" class="rounded mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cartqty" />
                                <br />
                                <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span> &nbsp;
                                &nbsp; <span class="fw-bold text-black">Rs.<?php echo $shipping; ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="card-body d-grid">
                                <a class="btn btn-outline-success mb-2" href="singleproductview.php?id=<?php echo $pro["pid"]; ?>">Pay For This</a>
                                <a class="btn btn-outline-danger mb-2" onclick="removecart(<?php echo $pro['cid'] ?>)">Remove</a>

                            </div>
                        </div>
                        <hr />
                        <div class="col-md-12 mt-3 mb-3">
                            <div class="row">
                                <div class="col-6 col-md-6">

                                    <span class="fw-bold text-black-50 fs-5">Requested total <i class="bi bi-exclamation-circle"></i></span>


                                </div>
                                <div class="col-6 col-md-6 text-end">
                                    <span class=" fs-5">Rs. <?php echo ($wlpro["price"] * $pro["cqty"]) + $shipping; ?> </span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            <?php





            }
            ?>
        </div>
    </div>
<?php
}
?>

<?php























?>