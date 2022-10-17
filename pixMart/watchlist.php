<?php
require "database.php";
session_start();
if (isset($_SESSION["user"])) {

    $watchlist = database::s("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["user"]["email"] . "';");
    $nrwl = $watchlist->num_rows;





















?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart Watchlist</title>
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
            <div class="row gx-2 gy-2">
                <?php require "header.php" ?>

                <div class="col-12 border border-1 border-secondary rounded">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Watchlist <li class="fa fa-heart text-danger"></li> </label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hr1">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" id="search" placeholder="Search in Wishlist" />
                                </div>
                                <div class="col-12 col-lg-2">
                                    <button class="col-12 btn btn-outline-primary" style="background-color: white;color:purple;border:solid purple 0.1px" onmouseover="this.style.color='white';this.style.backgroundColor='purple';this.style.border='solid white 0.1px'" onmouseout="this.style.color='purple';this.style.backgroundColor='white';this.style.border='solid purple 0.1px'" onclick="searchwishlist();">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hr1">
                        </div>
                        <div class="col-12 col-lg-2 border border border-start-0 border-top-0 border-bottom-0 border-end border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <nav class="nav nav-pills flex-column">
                                <a class="nav-link active" aria-current="page" href="#" style="background-color: purple;">My Watchlist</a>
                                <a class="nav-link" href="cart.php">My Cart</a>
                                <a class="nav-link" href="#">Recently Viewed</a>

                            </nav>
                        </div>


                        <div class="col-12 col-lg-9" id="wishlistproview">
                            <?php
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
                                    INNER JOIN `user` ON `user`.`email`=`product`.`user_email` WHERE `product`.`id`='".$pro["product_id"]."';");
                                    
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
                                                <input id="qty<?php echo $wlpro['id']?>" type="number" class="d-none form-control mb-1" value="1" min="1" max="<?php echo $wlpro["qty"]?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-4">
                                            <div class="card-body d-grid">
                                                <a class="btn btn-outline-success mb-2" href="singleproductview.php?id=<?php echo $wlpro["id"]; ?>">Buy Now</a>
                                                <a class="btn btn-outline-secondary mb-2" onclick="addtocart(<?php echo $wlpro['id']?>,<?php echo $wlpro['qty']?>)">Add Cart</a>
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



























                            
















                        </div>

                    </div>

                    <?php require "footer.php" ?>
                </div>
            </div>

            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    </body>

    </html>
<?php
} else {
    header("location:home.php");
}
?>