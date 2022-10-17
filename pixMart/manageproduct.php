<?php
require "database.php";
session_start();
if(isset($_SESSION["admin"])){
    ?>
    <!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PiXMart | Manage Users</title>

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

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage All Products</label>
            </div>
            <div class="col-12 bg-light rounded mt-2">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3 mt-3">
                        <div class="row">
                            <div class="col-9 ">
                                <input id="prosearch" type="text" class="form-control" />

                            </div>
                            <div class="col-3 d-grid ">
                                <button onclick="prosearch();" class="btn btn-primary">Search</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                                                        <ol class=" d-flex flex-wrap mb-1 mt-1 list-unstyled bg-white rounded">
                                                            <li class="breadcrumb-item ">
                                                                <a href="adminpannel.php">Admin Pannel</a>
                                                            </li>

                                                            <li class="breadcrumb-item active">
                                                                <a class="text-decoration-none text-black-50" href="#">Manage Products</a>
                                                            </li>
                                                        </ol>
                                                    </nav>
            <div class="col-12 mt-3 mb-2">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-info pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">product Image</span>
                    </div>
                    <div class="col-6 col-lg-2 bg-primary pt-2 pb-2 text-center">
                        <span class="fs-4 fw-bold text-white">title</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">price</span>
                    </div>
                    <div class="col-2 bg-primary pt-2 pb-2 text-center d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">User</span>
                    </div>
                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-4 col-lg-1 bg-white pt-2 pb-2"></div>
                </div>
            </div>

            <div id="products">
                <?php

                $pronum = database::s("SELECT * FROM `product` ; ");
                $n = $pronum->num_rows;
                $results_per_page = 10;
                $pages = ceil($n / $results_per_page);

                if (!isset($_GET["page"])) {
                    $pageno = 1;
                } else {
                    $pageno = $_GET["page"];
                }

                $page_first_result = ($pageno * $results_per_page) - $results_per_page;
                $user = database::s("SELECT * FROM `product`  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ; ");
                $un = $user->num_rows;

                for ($p = 0; $p < $un; $p++) {
                    $us = $user->fetch_assoc();
                    $i = database::s("SELECT * FROM `images` WHERE `product_id`='" . $us["id"] . "' ");
                    $img = $i->fetch_assoc();
                ?>

                    <?php

                    ?>


                    <div class="col-12 mt-3 mb-2">
                        <div class="row">
                            <div class="col-2 col-lg-1 bg-info pt-2 pb-2 text-end">
                                <span class="fs-5 fw-bold text-white"><?php echo $p + 1; ?></span>
                            </div>
                            <div onclick="prodet(<?php echo $us['id'] ?>);" class="col-2 bg-light d-none d-lg-block">
                                <img src="<?php echo $img["code"] ?>" alt="" style="height: 70px; margin-left: 70px;">
                            </div>
                            <div onclick="prodet(<?php echo $us['id'] ?>);" class="col-6 col-lg-2 bg-primary pt-2 pb-2 text-center">
                                <span class="fs-5 fw-bold text-white"><?php echo $us["title"] ?></span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold"><?php echo $us["price"] ?></span>
                            </div>
                            <div class="col-2 bg-primary pt-2 pb-2 text-center d-none d-lg-block">
                                <span class="fs-5 fw-bold text-white"><?php echo $us["user_email"] ?></span>
                            </div>
                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                <span class="fs-5 fw-bold"><?php echo explode(" ", $us["date_time_added"])["0"];    ?></span>
                            </div>
                            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                                <?php
                                if ($us["status_id"] == "1") {
                                ?>
                                    <button id="btn<?php echo $us['id'] ?>" class="btn btn-danger" onclick="blockproduct(<?php echo $us['id'] ?>);">Block</button>
                                <?php
                                } else {
                                ?>
                                    <button id="btn<?php echo $us['id'] ?>" class="btn btn-success" onclick="blockproduct(<?php echo $us['id'] ?>);">Unblock</button>
                                <?php
                                }

                                ?>

                            </div>
                        </div>
                    </div>
                    <!--singlepro view-->
                    <div class="modal fade" id="singleproview<?php echo $us["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel" ><?php echo $us["title"] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="<?php echo $img["code"] ?>" alt="" style="height: 100px;"><br/>

                                    <span>Price : Rs.<?php echo $us["price"] ?></span><br/>
                                    <span><?php echo $us["qty"] ?> Items Avalable</span><br/>
                                    <span>Seller : <?php echo $us["user_email"] ?></span><br/>
                                    <span>Description : Rs.<?php echo $us["description"] ?></span><br/>
                                    <span>Price : Rs.<?php echo $us["price"] ?></span><br/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary" onclick="buynow(singleproview<?php echo $us['id'] ?>);">Buy</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--singlepro view-->
                <?php
                }
                ?>

                <div class="col-12 text-center fs-5 fw-bold mt-3">
                    <div class="pagination" id="pag">
                        <!-- <a href="#">&laquo;</a>
                        <a href="#">1</a>
                        <a class="active" href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">&raquo;</a> -->

                        <div class="col-12 mb-3">
                            <div class="row">

                                <div class="pagination justify-content-center">
                                    <?php
                                    if ($pageno == 1) {
                                    ?>
                                        <a href="#" class="d-none">&laquo;</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="manageproduct.php?page=<?php echo $pageno - 1 ?>"><i class="bi bi-caret-left-fill"></i></a>
                                    <?php
                                    }
                                    ?>



                                    <?php
                                    for ($pn = 1; $pn <= $pages; $pn++) {
                                        if ($pn == $pageno) {
                                    ?>
                                            <a href="manageproduct.php?page=<?php echo $pn ?>" class="active"><?php echo $pn ?></a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="manageproduct.php?page=<?php echo $pn ?>"><?php echo $pn ?></a>

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
                                        <a href="manageproduct.php?page=<?php echo $pageno + 1 ?>"><i class="bi bi-caret-right-fill"></i></a>
                                    <?php
                                    }
                                    ?>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <hr />

                <div class="col-12">
                    <h3 class="text-white bg-dark">Manage Categories</h3>
                </div>

                <hr>

                <div class="col-12 mb-3">
                    <div class="row g-1">
                        <?php

                        $cat = database::s("SELECT * FROM `category`");
                        $num = $cat->num_rows;
                        for ($i = 0; $i < $num; $i++) {
                            $c = $cat->fetch_assoc();
                        ?>
                            <div class="col-12 col-lg-4">
                                <div class="row g-1 px-1">
                                    <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                        <label class="form-label fs-4 fw-bold py-3"><?php echo $c["name"] ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>


                        <div class="col-12 col-lg-4">
                            <div class="row g-1 px-1">
                                <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                    <div class="row">
                                        <div class="col-2 mt-3 addnewimg"></div>
                                        <div class="col-10">
                                            <label class="form-label fs-4 fw-bold py-3 text-black-50" onclick="addnewmodel();">Add New Category</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--model-->

                <div class="modal fade" id="addnew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input id="cat" type="text" class="form-control" placeholder="Category" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="addcat();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--model-->

                <?php require "footer.php"; ?>
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
}else{
    ?>
    <script>window.location="adminsignin.php"</script>
<?php
}
?>

