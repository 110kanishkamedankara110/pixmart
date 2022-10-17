<?php
    $search=$_POST["search"];
    $key=$search."%";
    session_start();
    require "database.php";
    $watchlist = database::s("SELECT * FROM `watchlist` INNER JOIN `product` ON `product`.`id`=`watchlist`.`product_id` WHERE `watchlist`.`user_email`='" . $_SESSION["user"]["email"] . "' AND `title` LIKE '".$key."'  ;");
    $nrwl = $watchlist->num_rows;
    if ($nrwl == 0) {
        ?>
            <!--without Item-->
            <div class="row">
                <div class="col-12 EmptyView"></div>
                <label style="font-family: 'Quicksand';" class="form-label fs-1 mb-3 fw-bolder text-center">You have no items in your wishlist</label>
            </div>
            <!--without Item-->
        <?php
        } else {
            for ($i = 0; $i < $nrwl; $i++) {
                $pro=$watchlist->fetch_assoc();
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
                INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='".$pro["product_id"]."'  ;");
                
                $wlpro=$products->fetch_assoc();
                $im = database::s("SELECT * FROM `images` WHERE `product_id`='" . $wlpro["id"] . "'; ");
                $imgpath = $im->fetch_assoc();
                ?>
                <div class="row g-2">
            <div class="card mb-3 mx-3 col-12">
                <div class=" row g-0">
                    <div class="col-md-4">
                        <img src="<?php echo $imgpath["code"]?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $wlpro["title"]?></h3>
                            <span class="fw-bold text-black-50">Colour : <?php echo $wlpro["color"]?></span>&nbsp; |
                            &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $wlpro["condition"]?></span>
                            <br />
                            <span class="fw-bold text-black-50 fs-5">Price :</span> | &nbsp;
                            &nbsp; <span class="fw-bold text-black">Rs. <?php echo $wlpro["price"]?></span>
                            <br />
                            <span class="fw-bold text-black-50 fs-5">Seller :</span>
                            <br />
                            <span class="fw-bold text-black"><?php echo $wlpro["first_name"]." ".$wlpro["last_name"]?></span>
                            <br />
                            <span class="fw-bold text-black"><?php echo $wlpro["email"]?></span>
                        </div>
                    </div>
                    <div class="col-md-3 mt-4">
                        <div class="card-body d-grid">
                            <a class="btn btn-outline-success mb-2" href="singleproductview.php?id=<?php echo $wlpro["id"]; ?>">Buy Now</a>
                            <a class="btn btn-outline-secondary mb-2" href="">Add Cart</a>
                            <a class="btn btn-outline-danger mb-2" onclick="addwatchlist2(<?php echo $wlpro['id'] ?>);">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php
            }
        }
?>