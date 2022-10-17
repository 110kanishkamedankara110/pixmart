<?php
session_start();
require "database.php";

if (isset($_SESSION["user"])) {

    $mail = $_SESSION["user"]["email"];

    $invoicers = database::s("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
    $in = $invoicers->num_rows;
?>



    <!DOCTYPE html>

    <html>

    <head>
        <title>PiXMart | Purchase History</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="recourses\logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    </head>

    <body>
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php require "header.php"; ?>

                <div class="col-12 text-center mb-3 d-none d-lg-block">
                    <span class="fs-1 fw-bold text-primary">Transaction History</span>
                </div>
                <div class="col-12 mb-3">
                                                    <nav>
                                                        <ol class=" d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                            <li class="breadcrumb-item ">
                                                                <a href="home.php">Home</a>
                                                            </li>

                                                            <li class="breadcrumb-item active">
                                                                <a class="text-decoration-none text-black-50" href="#">Purchase History</a>
                                                            </li>
                                                        </ol>
                                                    </nav>
                                                </div>


                <?php
                if ($in == 0) {
                ?>

                    <div class="col-12 text-center" style="height: 450px;">
                        <span style="margin-top: 200px;" class="bg-light fs-1 fw-bold text-black-50 d-block">You Have No Items In Your Transaction History yet....</span>
                    </div>
                <?php
                } else {
                ?>




                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 ">
                                <div class="row">
                                    <div class="col-2 bg-light d-none d-lg-block">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 bg-light">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-light text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-light text-end">
                                        <label class="form-label fw-bold">Purchase Daye & Time</label>
                                    </div>
                                    <div class="col-2 bg-light"></div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <?php
                                    for ($i = 0; $i < $in; $i++) {
                                        $da = $invoicers->fetch_assoc();
                                    ?>



                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-lg-2 bg-info ">
                                                    <label class="form-label text-white fs-5 px-3 py-5"><?php echo $da["order_id"] ?></label>
                                                </div>
                                                <div class="col-12 col-lg-3">
                                                    <div class="row">
                                                        <div class="card mx-3 my-3" style="max-width: 540px;" onclick="window.location='singleproductview.php?id=<?php echo $da['product_id']?>;'">
                                                            <div class="row g-0">
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    $pid = $da["product_id"];
                                                                    $array;
                                                                    $imagers = database::s("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "'");
                                                                    $n = $imagers->num_rows;

                                                                    for ($x = 0; $x < $n; $x++) {
                                                                        $f = $imagers->fetch_assoc();
                                                                        $array[$x] = $f["code"];
                                                                    }

                                                                    ?>


                                                                    <img src="<?php echo $array[0];  ?>" class="img-fluid rounded-start" alt="...">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="card-body">

                                                                        <?php
                                                                        $productrs = Database::s("SELECT  * FROM `product` WHERE `id`='" . $pid . "'");
                                                                        $pr = $productrs->fetch_assoc();
                                                                        ?>


                                                                        <h5 class="card-title"><?php echo $pr["title"];  ?></h5>

                                                                        <?php
                                                                        $sm = $pr["user_email"];
                                                                        $selllers = database::s("SELECT * FROM `user` WHERE `email`='" . $sm . "'");
                                                                        $sr = $selllers->fetch_assoc();
                                                                        ?>

                                                                        <p class="card-text"><b>Seller :</b><?php echo $sr["first_name"] . " " . $sr["last_name"];  ?></p>
                                                                        <p class="card-text"><b>Price :</b>Rs. <?php echo $pr["price"];  ?> .00</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-lg-1 text-start text-lg-end">
                                                    <label class="form-label fs-5 pt-5 fs-4">1</label>
                                                </div>
                                                <div class="col-12 col-lg-2 text-lg-end bg-info">
                                                    <label class="form-label text-white fs-5 px-3 p5-5">Rs. <?php echo $da["total"] ?> .00</label>
                                                </div>
                                                <div class="col-12 col-lg-2 text-start text-lg-end">
                                                    <label class="form-label pt-5 "><?php echo $da["date"] ?></label>
                                                </div>
                                                <div class="col-12 col-lg-2 mb-3">
                                                    <div class="row">
                                                        <div class="col-8 d-grid"><button onclick="AddFeedBack(<?php echo $pid ?>);" class="btn btn-primary rounded border border-1 border-primary mt-5 fs-5"><i class="bi bi-info-circle-fill"></i>&nbsp; Feedback</button></div>
                                                        <!-- <div class="col-6 d-grid"><button class="btn btn-primary rounded mt-5 fs-5"><i class="bi bi-trash-fill"></i>Delete</button></div> -->
                                                    </div>
                                                </div>

                                                <hr>

                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addFeedbackmodal<?php echo $pid; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $pr["title"]; ?></h5>
                                                        <button onclick="ref();" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control" id="feedtext<?php echo $pid?>" cols="30"  rows="10"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button onclick="ref();" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button  type="button" class="btn btn-primary" onclick="SaveFeedBack(<?php echo $pid; ?>);">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->

                                    <?php
                                    }
                                    ?>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>


                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="col-lg-10 d-none d-lg-block"> </div>
                            <!-- <div class="col-12 col-lg-2 d-grid">
                                <button class="btn btn-danger fs-4"><i class="bi bi-trash-fill"></i>Clear All Records</button>
                            </div> -->
                        </div>
                    </div>


                <?php
                }
                ?>
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
} else {
    header("location:home.php");
}

?>