<?php


require "database.php";
if ($_POST["k"] != "") {
    $key = $_POST["k"];
    $catagory = $_POST["c"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $condition = $_POST["con"];
    $color = $_POST["colo"];
    if ($_POST["pf"] != "") {
        if (is_numeric($_POST["pf"])) {
            $pricefrom = $_POST["pf"];
        } else {
            echo "Invalid Price From";
            $pricefrom = "";
        }
    } else {
        $pricefrom = "";
    }
    if ($_POST["pt"] != "") {
        if (is_numeric($_POST["pt"])) {
            $priceto = $_POST["pt"];
        } else {
            echo "Invalid Price To";
            $priceto = "";
        }
    } else {
        $priceto = "";
    }







    // $keyword = "%" . $key . "%";
    // $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' ");
    // $n = $pronum->num_rows;
    // $results_per_page = 1;
    // $pages = ceil($n / $results_per_page);

    // if (!isset($_POST["page"])) {
    //     $pageno = 1;
    // } else {
    //     $pageno = $_POST["page"];
    // }

    // $page_first_result = ($pageno * $results_per_page) - $results_per_page;






    if ($catagory != "0") {
        $keyword = "%" . $key . "%";
       
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `category_id`='" . $catagory . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;

        


        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `category_id`='" . $catagory . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ; ");
        
    } 
    if ($brand != "0") {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' )");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' ) LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ; ");
    } 
    if ($model != 0) {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $model . "')");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $model . "') LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ; ");
    }
    if ($condition != 0) {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `condition_id`='" . $condition . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `condition_id`='" . $condition . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ; ");
    } 
    if ($color != 0) {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `color_id`='" . $color . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `color_id`='" . $color . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ; ");
    }
    if ($pricefrom != "" && $priceto == "") {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `price`>'" . $pricefrom . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;

        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `price`>'" . $pricefrom . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "  ; ");
    } else if ($priceto != "" && $pricefrom == "") {
        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword .  "' AND `price`<'" . $priceto . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;

        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword .  "' AND `price`<'" . $priceto . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "; ");
    } else if ($pricefrom != "" && $priceto != "") {

        $keyword = "%" . $key . "%";
        $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword .  "' AND `price` BETWEEN '" . $pricefrom . "' AND '" . $priceto . "'");
        $n = $pronum->num_rows;
        $results_per_page = 1;
        $pages = ceil($n / $results_per_page);

        if (!isset($_POST["page"])) {
            $pageno = 1;
        } else {
            $pageno = $_POST["page"];
        }

        $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword .  "' AND `price` BETWEEN '" . $pricefrom . "' AND '" . $priceto . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "; ");
    }

    

    if($pricefrom=="" && $priceto=="" && $catagory=="0"&& $brand=="0"&& $model=="0"&& $condition=="0" && $color=="0"){
        
        $keyword = "%" . $key . "%";
    $pronum =  database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' ");
    $n = $pronum->num_rows;
    $results_per_page = 1;
    $pages = ceil($n / $results_per_page);

    if (!isset($_POST["page"])) {
        $pageno = 1;
    } else {
        $pageno = $_POST["page"];
    }

    $page_first_result = ($pageno * $results_per_page) - $results_per_page;
        $productrs = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "; ");
    }







    $pronr = $productrs->num_rows;
    for ($i = 0; $i < $pronr; $i++) {
        $r = $productrs->fetch_assoc();
        $img = database::s("SELECT * FROM `images` WHERE `product_id`='" . $r["id"] . "';");
        $url = $img->fetch_assoc();
        // echo $r["title"];
?>
        <div class="card mb-3 col-10 col-md-6 mt-3 ">
            <div class="row g-0">
                <div class="col-md-3 mt-4">
                    <img src="<?php echo $url["code"] ?>" class="img-fluid rounded-start">
                </div>
                <div class="col-md-9 ">

                    <div class="card-body m-1">
                        <h5 class="card-title fw-bold"><?php echo $r["title"] ?></h5>
                        <span class="card-text fw-bol text-primary">Rs.<?php echo $r["price"] ?></span><br />
                        <span class="card-text fw-bol text-success">Items Left <?php echo $r["qty"] ?></span>
                        <div class="form-check form-switch mb-3">



                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <a href="#" class="btn btn-success d-grid" style="font-size: 12px;" onclick="addtocart2(<?php echo $r['id'] ?>,<?php echo $r['qty'] ?>);">Add To Cart</a>

                                </div>
                                <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                    <a href="singleproductview.php?id=<?php echo $r["id"]; ?>" class="btn btn-danger d-grid" style="font-size: 12px;">Buy Now</a>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php
        // if ($catagory != "0") {

        //     $cat = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `catagory`='" . $catagory . "' ; ");
        // } else if ($brand != "0") {
        //     $br = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "') ; ");

        //     $numb = $br->num_rows;
        //     for ($n = 0; $n < $numb; $n++) {
        //         $row = $br->fetch_assoc();
        //         echo $row["title"];
        //     }
        // } else if ($model != 0) {
        //     $mo = database::s("SELECT * FROM `product` WHERE `description` LIKE '" . $keyword . "' AND `Model_has_brand_id1` IN (SELECT `id` FROM `model_has_brand` WHERE `model_id`='" . $model . "') ; ");

        //     $numm = $mor->num_rows;
        //     for ($n = 0; $n < $numm; $n++) {
        //         $rowm = $mo->fetch_assoc();
        //         echo $rown["title"];
        //     }
        // }
    }
    ?>
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
                    <a onclick="advsearch(<?php echo $pageno - 1 ?>)"><i class="bi bi-caret-left-fill"></i></a>
                <?php
                }
                ?>



                <?php
                for ($pn = 1; $pn <= $pages; $pn++) {
                    if ($pn == $pageno) {
                ?>
                        <a onclick="advsearch(<?php echo $pn ?>)" class="active"><?php echo $pn ?></a>
                    <?php
                    } else {
                    ?>
                        <a onclick="advsearch(<?php echo $pn ?>)"><?php echo $pn ?></a>

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
                    <a onclick="advsearch(<?php echo $pageno + 1 ?>)"><i class="bi bi-caret-right-fill"></i></a>
                <?php
                }
                ?>

            </div>


        </div>
    </div>
<?php
} else {
    echo "You Must enter a Keyword to search";
}

// echo $key." ";
// echo $catagory." ";
// echo $brand." ";
// echo $model." ";
// echo $condition." ";
// echo $color." ";
// echo $pricefrom." ";
// echo $priceto." ";
