<?php
session_start();
$search = $_POST["search"];
$fil = $_POST["fil"];

$condition = $_POST["condition"];

if ($condition == "used") {
    $condition = 2;
} else if ($condition == "brandnew") {
    $condition = 1;
} else {
    $condition = "";
}

// echo $search;
// echo $age;
// echo $quentity;
// echo $condition;

require "database.php";

$title = $search . "%";
// $result=database::s("SELECT * FROM `product` WHERE `title` LIKE '".$title."' ");
// $nr=$$result->num_rows;
// for($i=0;$i<$nr;$i++){

if ($condition == "") {
    if ($fil == "new to old") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND  `title` LIKE '" . $title . "' ORDER BY `date_time_added` DESC ");
    } else if ($fil == "old to new") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND  `title` LIKE '" . $title . "' ORDER BY `date_time_added` ASC ");
    } else if ($fil == "low to high") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND  `title` LIKE '" . $title . "' ORDER BY `qty` ASC ");
    } else if ($fil == "high to low") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND  `title` LIKE '" . $title . "' ORDER BY `qty` DESC ");
    }
    else{
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND  `title` LIKE '" . $title . "'; ");
    }
} else {
    if ($fil == "new to old") {
    } else if ($fil == "old to new") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `condition_id`='" . $condition . "' AND `title` LIKE '" . $title . "' ORDER BY `date_time_added` DESC ");
    } else if ($fil == "low to high") {
        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `condition_id`='" . $condition . "' AND `title` LIKE '" . $title . "' ORDER BY `date_time_added` ASC ");
    } else if ($fil == "high to low") {

        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `condition_id`='" . $condition . "' AND `title` LIKE '" . $title . "' ORDER BY `qty` ASC ");
    }
    else{

        $product = database::s("SELECT * FROM `product` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `condition_id`='" . $condition . "' AND `title` LIKE '" . $title . "' ORDER BY `qty` DESC ");
    }
}





$psrn = $product->num_rows;

for ($p = 0; $p < $psrn; $p++) {
    $item = $product->fetch_assoc();
    $img2 = database::s("SELECT * FROM `images` WHERE `product_id`='" . $item["id"] . "'; ");
    $imglink = $img2->fetch_assoc();
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
                            <div class="col-12">
                                <a href="updateproduct.php?id=<?php echo$item["id"] ?>" class="btn btn-success d-grid" style="font-size: 12px;">Update Product</a>

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