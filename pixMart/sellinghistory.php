<?php
session_start();

require "database.php";
$from = $_GET["f"];
$to = $_GET["t"];
if (isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PiXMart | Sell History</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="recourses\logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="bgbg">
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 bg-light text-center rounded ">
                    <label for="" class="form-label fs-2 fw-bold text-primary">Product Selling History</label>
                </div>
                <nav>
                    <ol class=" d-flex flex-wrap mb-1 mt-1 list-unstyled bg-white rounded">
                        <li class="breadcrumb-item ">
                            <a href="adminpannel.php">Admin Pannel</a>
                        </li>

                        <li class="breadcrumb-item active">
                            <a class="text-decoration-none text-black-50" href="#">Selling History</a>
                        </li>
                    </ol>
                </nav>
                <div class="col-12 mt-3 mb-2 d-none d-lg-block">
                    <div class="row">

                        <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                            <span class="fs-4 fw-bold text-white">Order ID</span>
                        </div>

                        <div class="col-5 col-lg-3 bg-light pt-2 pb-2 d-lg-block">
                            <span class="fs-4 fw-bold">Product</span>
                        </div>

                        <div class="col-3 bg-primary pt-2 pb-2  d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white">Buyer</span>
                        </div>

                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold">Price</span>
                        </div>

                        <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                            <span class="fs-4 fw-bold">Quantity</span>
                        </div>


                    </div>
                </div>
                <?php
                if (!empty($from) && empty($to)) {
                    $fromrs = database::s("SELECT * FROM `invoice`");
                    $fn = $fromrs->num_rows;
                    for ($i = 0; $i < $fn; $i++) {
                        $fr = $fromrs->fetch_assoc();
                        $fromdate = $fr["date"];

                        $splitdate = explode(" ", $fromdate);
                        $date = $splitdate[0];

                        if ($from == $date) {
                            $porrs = database::s("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'; ");
                            $pro = $porrs->fetch_assoc();
                            $userrs = database::s("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "'; ");
                            $user = $userrs->fetch_assoc();


                ?>
                            <div class="col-12 mb-2">

                                <div class="row">

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["title"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $user["first_name"]  . " " . $user["last_name"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["price"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["qty"] ?></span>
                                    </div>

                                </div>
                            </div>




                        <?php
                        }
                    }
                } else if (!empty($from) && !empty($to)) {
                    $fromrs = database::s("SELECT * FROM `invoice`");
                    $fn = $fromrs->num_rows;
                    for ($i = 0; $i < $fn; $i++) {
                        $fr = $fromrs->fetch_assoc();
                        $fromdate = $fr["date"];

                        $splitdate = explode(" ", $fromdate);
                        $date = $splitdate[0];

                        if ($from <= $date && $to >= $date) {
                            $porrs = database::s("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'; ");
                            $pro = $porrs->fetch_assoc();
                            $userrs = database::s("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "'; ");
                            $user = $userrs->fetch_assoc();


                        ?>
                            <div class="col-12 mb-2">

                                <div class="row">

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["title"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $user["first_name"]  . " " . $user["last_name"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["price"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["qty"] ?></span>
                                    </div>

                                </div>
                            </div>




                        <?php
                        }
                    }
                } else if (empty($from) && empty($to)) {
                    $fromrs = database::s("SELECT * FROM `invoice`");
                    $fn = $fromrs->num_rows;
                    $date = new DateTime();
                    $tz = new DateTimeZone("Asia/Colombo");
                    $date->setTimezone($tz);
                    $today = $date->format("Y-m-d");
                    for ($i = 0; $i < $fn; $i++) {
                        $fr = $fromrs->fetch_assoc();
                        $fromdate = $fr["date"];

                        $splitdate = explode(" ", $fromdate);
                        $date = $splitdate[0];

                        if ($today == $date) {
                            $porrs = database::s("SELECT * FROM `product` WHERE `id`='" . $fr["product_id"] . "'; ");
                            $pro = $porrs->fetch_assoc();
                            $userrs = database::s("SELECT * FROM `user` WHERE `email`='" . $fr["user_email"] . "'; ");
                            $user = $userrs->fetch_assoc();


                        ?>
                            <div class="col-12 mb-2">

                                <div class="row">

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["order_id"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["title"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $user["first_name"]  . " " . $user["last_name"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $pro["price"] ?></span>
                                    </div>

                                    <div class="col-8 offset-2 offset-lg-0 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $fr["qty"] ?></span>
                                    </div>

                                </div>
                            </div>




                <?php
                        }
                    }
                }


                ?>

                <div class="col-12 justify-content-center d-flex mt-3 mb-3">
                    <!-- <div class="pagination">
                        <?php
                        if ($pageno == 1) {
                        ?>
                            <a href="#" class="d-none">&laquo;</a>
                        <?php
                        } else {
                        ?>
                            <a href="sellinghistory.php?page=<?php echo $pageno - 1 ?>"><i class="bi bi-caret-left-fill"></i></a>
                        <?php
                        }
                        ?>



                        <?php
                        for ($pn = 1; $pn <= $pages; $pn++) {
                            if ($pn == $pageno) {
                        ?>
                                <a href="sellinghistory.php?page=<?php echo $pn ?>" class="active"><?php echo $pn ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="sellinghistory.php?page=<?php echo $pn ?>"><?php echo $pn ?></a>

                        <?php
                            }
                        }
                        ?>

                        <?php
                        if ($pageno == $pages) {
                        ?>
                            <a href="#" class="d-none">&raquo;</a>
                        <?php
                        } else {
                        ?>
                            <a href="sellinghistory.php?page=<?php echo $pageno + 1 ?>"><i class="bi bi-caret-right-fill"></i></a>
                        <?php
                        }
                        ?>
                    </div> -->
                </div>

                <?php require "footer.php" ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "adminsignin.php"
    </script>
<?php
}
// echo $from." ".$to
?>