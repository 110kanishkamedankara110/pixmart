<?php
session_start();



if (isset($_GET["id"])) {
    $id = $_GET["id"];
    require "database.php";
    $pro = database::s("SELECT `product`.`id`,`category`.`name` 
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
    INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE product.`id`='" . $id . "'; ");
    $prodet = $pro->fetch_assoc();

    if (isset($_SESSION["user"])) {
        $wl = database::s("SELECT * FROM `watchlist`  WHERE `product_id`='" . $id . "' AND `user_email`='" . $_SESSION["user"]["email"] . "' ;");
        $nwl = $wl->num_rows;
    }

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart Productview</title>
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
                require "header.php";


                ?>
                <div class="col-12 mt-0 singleproduct">
                    <div class="row">
                        <div class="bg-white" style="padding:11px">
                            <div class="row">
                                <div class="col-lg-2 order-lg-1 order-2">
                                    <ul>
                                        <?php
                                        $im = database::s("SELECT * FROM `images` WHERE `product_id`='" . $id . "'; ");
                                        $nr = $im->num_rows;
                                        for ($i = 0; $i < $nr; $i++) {
                                            $img = $im->fetch_assoc();
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <div class="col-12 mt-1 mb-1 imim" style="background-image: url('<?php echo $img["code"] ?>');" onclick="bm('<?php echo $img['code'] ?>');"></div>
                                            </li>
                                        <?php
                                        }

                                        ?>





                                    </ul>
                                </div>
                                <div class="col-lg-5 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="d-flex flex-column align-items-center  border border-1 border-secondary p-3">
                                        <div id="bm" class="col-12 mt-1 mb-1 imimim" style="background-image: url('<?php echo $img["code"] ?>');"></div>
                                    </div>
                                </div>
                                <div class="col-lg-5 order-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <nav>
                                                        <ol class=" d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                            <li class="breadcrumb-item ">
                                                                <a href="home.php">Home</a>
                                                            </li>

                                                            <li class="breadcrumb-item active">
                                                                <a class="text-decoration-none text-black-50" href="#">Single View</a>
                                                            </li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fs-4 fw-bold mt-0"><?php echo $prodet["title"] ?></label>

                                                </div>
                                                <div class="col-12 mt-1 fs-5 ">
                                                    <span class="badge badge-sucess">
                                                        <i class="bi bi-star-fill text-warning"></i>&nbsp;<label class="text-black-50"> 4.5 Stars </label>&nbsp;
                                                        <label class="text-black-50">35 Ratings And 45 Reviews</label>
                                                    </span>
                                                </div>
                                                <div class="col-12">
                                                    <label class=" fw-bold mt-1 fs-5  text-danger ">Rs. <?php echo $prodet["price"] ?></label>&nbsp;&nbsp;
                                                    <!-- <label class=" fw-bold mt-1 fs-4  ">Rs. <?php echo $prodet["price"] - (($prodet["price"] / 100) * 5) ?></label> -->
                                                </div>

                                                <hr class="hr1" />
                                                <div class="col-12">
                                                    <label class="text-primary fs-6 ">
                                                        <b>Warrenty : </b>6 months warrenty
                                                    </label><br />
                                                    <label class="text-primary fs-6 ">
                                                        <b>Return Policy : </b>1 months Return
                                                    </label><br />
                                                    <label class="text-primary fs-6 ">
                                                        <b>In Stock : </b><?php echo $prodet["qty"] ?> Items left
                                                    </label><br />
                                                    <hr />
                                                    <label class="text-black-50 fs-6 ">
                                                        <b>Seller : </b><?php echo $prodet["first_name"] . " " . $prodet["last_name"] ?>
                                                    </label><br />
                                                    <label class="text-black-50 fs-6 mb-3">
                                                        <b>Seller Mail : </b><?php echo $prodet["email"] ?>
                                                    </label>
                                                    <a class="mt-2 btn btn-secondary" href="massage.php?to=<?php echo $prodet['email'] ?>">
                                                        Contact Seller
                                                    </a>
                                                    <hr />
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <!-- <div class="rounded border border-1 border-warning mt-1">
                                                            <div class="row">
                                                                <div class="col-md-2 col-sm-2">
                                                                    <img src="single product view\pricetag.png" />

                                                                </div>
                                                                <div class="col-md-10 col-sm-10">
                                                                    <label style="font-size: 12px;">
                                                                        Stand a chance to het instant 5% discount by using VISA
                                                                    </label> 
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                    </div>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <!-- <div class="row" style="margin-top:15px">
                                                        <div class="col-md-6" style="margin-top: 15px;">
                                                            <label class="fs-6 mt-1 fw-bold ">Color Options</label><br />
                                                            <button class="btn btn-primary">Black</button>
                                                            <button class="btn btn-primary">Gold</button>
                                                            <button class="btn btn-primary">Blue</button>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <hr class="hr1" />

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-7" style="margin-top:15px">
                                                            <div class="row">
                                                                <div class="position-relative productqty overflow-hidden float-start rounded border border-1 border-secondary">
                                                                    <span class="mt-2">Qty : </span>
                                                                    <input disabled style="outline: none;;" class=" border-0  fs-6 fw-bold" type="text" value="1" id="qty<?php echo $id ?>" />
                                                                    <div class="position-absolute qty-buttons">
                                                                        <div class=" border border-1 border-secondary d-flex flex-column align-items-center qty-inc" onclick="up(<?php echo $prodet['qty'] ?>,<?php echo $id ?>);">
                                                                            <i class="bi bi-chevron-compact-up"></i>
                                                                        </div>
                                                                        <div class=" border border-1 border-secondary d-flex flex-column align-items-center qty-dec" onclick="down(<?php echo $id ?>);">
                                                                            <i class="bi bi-chevron-compact-down"></i>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-12">
                                                            <div class="row">

                                                                <?php
                                                                if (isset($_SESSION["user"])) {
                                                                ?>
                                                                    <div class="col-5 col-lg-4 d-grid">
                                                                        <button class="btn btn-primary mb-1 d-block" onclick="addtocart(<?php echo $id ?>,<?php echo $prodet['qty'] ?>)">Add to cart</button>
                                                                    </div>

                                                                    <?php

                                                                    if ($prodet["qty"] == 0) {
                                                                    } else {
                                                                    ?>
                                                                        <div class="col-5 col-lg-4 d-grid">
                                                                            <button class="btn btn-success d-block" id="payhere-payment" onclick="paynow(<?php echo $id ?>)" type="submit">Buy now</button>
                                                                        </div>
                                                                    <?php
                                                                    }

                                                                    ?>



                                                                <?php
                                                                }
                                                                ?>


                                                                <div class="col-2 col-lg-4 d-grid">
                                                                    <?php
                                                                    if ($prodet["qty"] == 0) {
                                                                    } else {
                                                                    ?>
                                                                        <?php
                                                                        if (isset($_SESSION["user"])) {
                                                                            $h = "heart" . $id;
                                                                            if ($nwl == 1) {
                                                                        ?>
                                                                                <a onclick="addwatchlist(<?php echo $id ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart-fill"></i></a>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <a onclick="addwatchlist(<?php echo $id ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart"></i></a>
                                                                        <?php
                                                                            }
                                                                        }

                                                                        ?>
                                                                    <?php
                                                                    }


                                                                    ?>

                                                                </div>


                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 bg-white">
                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                        <div class="col-md-6">
                            <span class="fs-3 fw-bold">Related Items</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 bg-white">
                    <div class="row">
                        <?php
                        $simpro = database::s("SELECT `product`.`id`,`category`.`name` 
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
                        INNER JOIN `condition` ON `condition`.`id`=`product`.`condition_id` INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `brand`.`name`='" . $prodet["brand"] . "' AND product.`id`!='" . $id . "' LIMIT 4 ; ");
                        $sn = $simpro->num_rows;
                        for ($f = 0; $f < $sn; $f++) {
                            $sp = $simpro->fetch_assoc();
                            $pim = database::s("SELECT * FROM `images` WHERE `product_id`='" . $sp["id"] . "'; ");
                            $spimg = $pim->fetch_assoc();

                            if (isset($_SESSION["user"])) {
                                $wl2 = database::s("SELECT * FROM `watchlist`  WHERE `product_id`='" . $sp["id"] . "' AND `user_email`='" . $_SESSION["user"]["email"] . "' ;");
                                $nwl2 = $wl2->num_rows;
                                $h2 = "heart" . $sp["id"];
                            }

                        ?>
                            <div class="col-md-3 col-5">
                                <div class="row p-2">
                                    <div class="card me-1" style="width: 18rem;">
                                        <img src="<?php echo $spimg["code"]; ?>" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $sp["title"] ?></h5>
                                            <p class="card-text">Rs.<?php echo $sp["price"] ?></p>
                                            <?php
                                            if (isset($_SESSION["user"])) {
                                            }
                                            if ($sp["qty"] == 0) {
                                                ?>
                                                <input id="qty<?php echo $sp['id'] ?>" type="number" class="form-control mb-1" value="0" min="0" max="<?php echo $sp["qty"] ?>" />
                                          
                                                <?php
                                            } else {
                                            ?>
                                                <input id="qty<?php echo $sp['id'] ?>" type="number" class="form-control mb-1" value="1" min="1" max="<?php echo $sp["qty"] ?>" />

                                                <a class="btn btn-primary" onclick="addtocart(<?php echo $sp['id'] ?>,<?php echo $sp['qty'] ?>)">Add to cart</a>

                                                <a href="singleproductview.php?id=<?php echo $sp["id"]; ?>" class="btn btn-success">Buy Now</a>
                                                <?php
                                                if (isset($_SESSION["user"])) {
                                                    if ($nwl2 == 1) {
                                                ?>
                                                        <a onclick="addwatchlist(<?php echo $sp['id'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h2; ?>" class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a onclick="addwatchlist(<?php echo $sp['id'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h2; ?>" class="bi bi-heart"></i></a>
                                            <?php
                                                    }
                                                }
                                            }



                                            ?>
                                        </div>
                                    </div>



                                </div>
                            </div>

                        <?php
                        }






                        ?>



                    </div>
                </div>
                <div class="col-12 bg-white">
                    <div class="row d-block me-0 ms-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                        <div class="col-md-6">
                            <span class="fs-3 fw-bold">Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 bg-white">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <label class="form-label fs-5 fw-bold">Brand</label>
                                </div>
                                <div class="col-10">
                                    <label class="form-label"><?php echo $prodet["brand"] ?></label>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <label class="form-label">Model</label>
                                </div>
                                <div class="col-10">
                                    <label class="form-label"><?php echo $prodet["model"] ?></label>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <label class="form-label">Description</label>
                                </div>
                                <div class="col-10">
                                    <textarea disabled cols="50" rows="10"><?php echo $prodet["description"] ?></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <div class="col-12 bg-white">
                <div class="row d-block me-0 ms-o mb-3 mt-4 border border-1 border-start-0 border-end-0 border-top-0">
                    <div class="col-md-6 ">
                        <span class="fs-3 fw-bold">Feedbacks...</span>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="row g-1">

                    <?php
                    $feedbackrs = database::s("SELECT * FROM `feedback` INNER JOIN `user` ON `user`.`email`=`feedback`.`user_email`  WHERE `product_id`='" . $id . "'");
                    $feeds = $feedbackrs->num_rows;

                    if ($feeds == 0) {
                    ?>
                        <div class="col-12">
                            <label class="form-label ms-3 text-center">There No Feedback to view</label>
                        </div>

                        <?php
                    } else {
                        for ($a = 0; $a < $feeds; $a++) {
                            $res = $feedbackrs->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-3 border border-2 mx-1 rounded border-danger">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="fs-5 fw-bold text-primary"><?php echo $res["first_name"] . " " . $res["last_name"] ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="fs-6  fw-light text-black"><?php echo $res["feed"] ?>.</span>
                                    </div>
                                    <div class="col-12 text-end ">
                                        <span class="fs-6 text-info"><?php echo $res["date"] ?></span>
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
        require "footer.php";
        ?>
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
    header("location:home.php");
}
?>