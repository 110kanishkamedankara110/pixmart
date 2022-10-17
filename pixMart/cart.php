<?php
session_start();
if (isset($_SESSION["user"])) {
    require "database.php";
    $cart = database::s("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["user"]["email"] . "';");
    $cpronr = $cart->num_rows;
    $totprice = 0;
    $totship = 0;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart cart</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="recourses\logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                require "header.php"
                ?>




                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">cart <i class="bi bi-cart3 "></i> </label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hr1">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" id="search" placeholder="Search in Cart" />
                                </div>
                                <div class="col-12 col-lg-2">
                                    <button class="col-12 btn btn-outline-primary" style="background-color: white;color:purple;border:solid purple 0.1px" onmouseover="this.style.color='white';this.style.backgroundColor='purple';this.style.border='solid white 0.1px'" onmouseout="this.style.color='purple';this.style.backgroundColor='white';this.style.border='solid purple 0.1px'" onclick="searchcart();" >Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hr1">
                        </div>

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
                                        <a href="home.php" class="btn btn-primary" style="background-color: purple;border:white">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-11 col-lg-9" id="show">
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
                                INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='" . $pro["product_id"] . "'  ;");

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
                                        $totprice = $totprice + $wlpro["price"] * $pro["qty"];
                                        $totship = $totship + $shipping;
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
                                                <div class="col-md-4 " onmouseover="pop(<?php echo $pro['product_id']; ?>)" onmouseout="pop2(<?php echo $pro['product_id']; ?>)">
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
                                                        <input disabled id="qty<?php echo $wlpro['id'] ?>" type="text" value="<?php echo $pro["qty"] ?>" class="rounded mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cartqty" />
                                                        <br />
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span> &nbsp;
                                                        &nbsp; <span class="fw-bold text-black">Rs.<?php echo $shipping; ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-4">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2" href="singleproductview.php?id=<?php echo $pro["product_id"]; ?>">Pay For This</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="removecart(<?php echo $pro['id'] ?>)">Remove</a>

                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">

                                                            <span class="fw-bold text-black-50 fs-5">Requested total <i class="bi bi-exclamation-circle"></i></span>


                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class=" fs-5">Rs. <?php echo ($wlpro["price"] * $pro["qty"]) + $shipping; ?> </span>
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








                        <div class="col-12 col-lg-3" id="sum">
                            <div class="row">
                                <div class=" col-12">
                                    <label class="form-label fs-3 fw-bold">
                                        Summary
                                    </label>
                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="fs-6 fw-bold"> Items (<?php echo $cpronr ?>) </span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fs-6 fw-bold ">Rs. <?php echo $totprice ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="fs-6 fw-bold"> Shipping </span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fs-6 fw-bold ">Rs.<?php echo $totship ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="fs-4 fw-bold"> Total </span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fs-4 fw-bold ">Rs.<?php echo $totprice + $totship ?> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 d-grid mb-3">
                                        <button class="btn btn-primary fs-5 fw-bold" onclick="checkout();" style="background-color: purple;border:white">CHECKOUT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



















                <?php
                require "footer.php"
                ?>
            </div>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    </body>

    </html>
<?php
} else {
    header("location:index.php");
}
