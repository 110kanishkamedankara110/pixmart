<?php
$s = $_POST["search"];
require "database.php";
$search = $s . "%";


?>
<?php



$user = database::s("SELECT * FROM `product` WHERE `title` LIKE '" . $search . "' ; ");
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
                    <h5 class="modal-title" id="staticBackdropLabel"><?php echo $us["title"] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?php echo $img["code"] ?>" alt="" style="height: 100px;"><br />

                    <span>Price : Rs.<?php echo $us["price"] ?></span><br />
                    <span><?php echo $us["qty"] ?> Items Avalable</span><br />
                    <span>Seller : <?php echo $us["user_email"] ?></span><br />
                    <span>Description : Rs.<?php echo $us["description"] ?></span><br />
                    <span>Price : Rs.<?php echo $us["price"] ?></span><br />
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