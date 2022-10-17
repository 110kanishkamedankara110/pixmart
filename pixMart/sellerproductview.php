<?php

session_start();
require "database.php";
if (isset($_SESSION["user"])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart User Profile</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="recourses\logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    </head>

    <body style="overflow-x: hidden;background-color: #E9EBEE;">
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <!--head-->

                <div class="col-12 " style="background-color: purple;">
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <?php
                                $user = database::s("SELECT * FROM `user` WHERE `email`='" . $_SESSION["user"]["email"] . "'; ");
                                $userimg = $user->fetch_assoc();
                                if ($userimg["image"] == "NULL") {
                                ?>
                                    <div class="col-md-4 col-12 mt-1 mb-1">
                                        <img class="rounded-circle" height="90px" width="90px" src="recourses\demoProfileImg.jpg" />
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-4 col-12 mt-1 mb-1">
                                        <img class="rounded-circle" height="90px" width="90px" src="<?php echo $userimg["image"] ?>" />
                                    </div>
                                <?php
                                }
                                ?>



                                <div class="col-md-8 col-12">
                                    <div class="row">
                                        <div class="col-12 mt-4 text-white">
                                            <span class="fw-bold"><?php echo $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"] ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $_SESSION["user"]["email"] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <h1 class="text-white fw-bold ">My Products</h1>
                                </div>
                            </div>
                        </div>










                    </div>
                    <div class="col-12">
                        <nav>
                            <ol class=" d-flex flex-wrap mb-2 list-unstyled bg-white rounded">
                                <li class="breadcrumb-item ">
                                    <a href="home.php">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    <a class="text-decoration-none text-black-50" href="#">My Products</a>
                                </li>
                            </ol>
                        </nav>
                    </div>

                </div>

                <!--head-->
                <div class="col-12">
                    <div class="row">
                        <!--sortings-->
                        <div class="mx-lg-3 mb-3 col-10 offset-1 offset-lg-0 col-lg-2 mb-3 mt-3  rounded bg-body border" style="border: solid purple">
                            <div class="row">
                                <div class="col-10 mt-3 fs-5">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold fs-3 ">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" id="s" class=" form-control" placeholder="Search" />
                                                </div>
                                                <div class="col-1">
                                                    <label class="form-label fs-4 "><i class="bi bi-search"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12" style="font-size: 14px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label" for="n">
                                                    New to Old
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label" for="o">
                                                    Old to New
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold mt-3">By Quentity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12" style="font-size: 14px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="l">
                                                <label class="form-check-label " for="l">
                                                    Low to Heigh
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input " type="radio" name="flexRadioDefault" id="h">
                                                <label class="form-check-label " for="h">
                                                    Heigh to Low
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label fw-bold mt-3">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12 " style="font-size: 14px;">
                                            <div class="form-check">
                                                <input class="form-check-input " type="radio" name="flexRadioDefault2" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input " type="radio" name="flexRadioDefault2" id="bn">
                                                <label class="form-check-label " for="bn">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class=" col-12 my-3 mx-3 mt-3 d-grid  btn btn-success mb-1" onclick="addfilters();">Search</button>
                                            <button class="col-12 my-3 mx-3 mt-3 d-grid btn btn-primary" style="background-color: purple;"  onclick="clr();">Clear Filters</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--sortings-->

                        <!--product-->
                        <div class="mx-lg-3 mt-3 mb-3 col-10 offset-1 offset-lg-0 col-lg-9   bg-white">
                            <div class="row">
                                <div class="offset-1 col-10 text-center">
                                    <div class="row" id="prodiv">
                                        <?php

                                        $pronum = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ; ");
                                        $n = $pronum->num_rows;
                                        $results_per_page = 6;
                                        $pages = ceil($n / $results_per_page);

                                        if (!isset($_GET["page"])) {
                                            $pageno = 1;
                                        } else {
                                            $pageno = $_GET["page"];
                                        }

                                        $page_first_result = ($pageno * $results_per_page) - 6;
                                        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'  LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ; ");
                                        $psrn = $product->num_rows;

                                        for ($p = 0; $p < $psrn; $p++) {
                                            $item = $product->fetch_assoc();
                                            $img2 = database::s("SELECT * FROM `images` WHERE `product_id`='" . $item["id"] . "'; ");
                                            $imglink = $img2->fetch_assoc();
                                        ?>

                                            <?php

                                            ?>
                                            <div class="card mb-3 col-10 col-md-6 mt-3 ">
                                                <div class="row g-0">
                                                    <div class="col-md-3 mt-4">
                                                        <img src="<?php echo $imglink["code"] ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-md-9 ">

                                                        <div class="card-body m-1">
                                                            <h5 class="card-title fw-bold"><?php echo $item["title"] ?></h5>
                                                            <span class="card-text fw-bol text-primary"><?php echo "Rs " . $item["price"] ?></span><br />
                                                            <span class="card-text fw-bol text-success"><?php echo $item["qty"] . " Items Left" ?></span>
                                                            <div class="form-check form-switch mb-3">
                                                                <?php
                                                                if ($item["status_id"] == "2") {
                                                                ?>
                                                                    <input checked class="form-check-input" type="checkbox" role="switch" id="<?php echo "flexSwitchCheckDefault" . $p ?>" onchange="changestatus(<?php echo $item['id'] ?>,'<?php echo 'flexSwitchCheckDefault' . $p ?>','<?php echo 'lab' . $p ?>')">
                                                                    <label style="font-size: 12px;" class="form-check-label tw-bold" for="<?php echo "flexSwitchCheckDefault" . $p ?>" id="<?php echo "lab" . $p ?>">Make Your Product Active</label>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input class="form-check-input" type="checkbox" role="switch" id="<?php echo "flexSwitchCheckDefault" . $p ?>" onchange="changestatus(<?php echo $item['id'] ?>,'<?php echo 'flexSwitchCheckDefault' . $p ?>','<?php echo 'lab' . $p ?>')  ">
                                                                    <label style="font-size: 12px;" class="form-check-label tw-bold" for="<?php echo "flexSwitchCheckDefault" . $p ?>" id="<?php echo "lab" . $p ?>">Make Your Product Deactive</label>
                                                                <?php
                                                                }

                                                                ?>


                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-12 ">
                                                                        <a href="updateproduct.php?id=<?php echo $item["id"] ?>" class="btn btn-success d-grid" style="font-size: 12px;">Update Product</a>

                                                                    </div>
                                                                    <!-- <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                        <a class="btn btn-danger d-grid" style="font-size: 12px;" onclick="deletemodel(<?php echo $item['id'] ?>);">Delete Product</a>

                                                                    </div> -->
                                                                </div>
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
                            </div>

                        </div>

                        <!--product-->
                    </div>
                </div>







                <!--pagination-->
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
                                <a href="sellerproductview.php?page=<?php echo $pageno - 1 ?>"><i class="bi bi-caret-left-fill"></i></a>
                            <?php
                            }
                            ?>



                            <?php
                            for ($pn = 1; $pn <= $pages; $pn++) {
                                if ($pn == $pageno) {
                            ?>
                                    <a href="sellerproductview.php?page=<?php echo $pn ?>" class="active"><?php echo $pn ?></a>
                                <?php
                                } else {
                                ?>
                                    <a href="sellerproductview.php?page=<?php echo $pn ?>"><?php echo $pn ?></a>

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
                                <a href="sellerproductview.php?page=<?php echo $pageno + 1 ?>"><i class="bi bi-caret-right-fill"></i></a>
                            <?php
                            }
                            ?>

                        </div>


                    </div>
                </div>
                <!--pagination-->
                <!--model-->
                <div class="modal fade" id="deletemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Shure To Delete This Product
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" id="delbut">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--model-->
                <!--footer-->
                <?php
                require "footer.php";

                ?>
                <!--footer-->
            </div>
        </div>


























        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    </body>

    </html>
<?php



} else {
    header("location:index.php");
}












?>
<?php



















?>