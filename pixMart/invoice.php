<?php
session_start();





if (isset($_SESSION["user"])) {

    if (isset($_GET["id"])) {
        $subtot = 0;
        $dis = 0;
        require "database.php";
        $invoice = database::s("SELECT * FROM `invoice` WHERE invoice.`order_id`='" . $_GET["id"] . "'");
        $nr = $invoice->num_rows;
        $time = database::s("SELECT * FROM `invoice` WHERE invoice.`order_id`='" . $_GET["id"] . "'");
        $t = $time->fetch_assoc();
        $addres = database::s(" SELECT * FROM `user_has_address` INNER JOIN 
        `location` ON `location`.`id`=`user_has_address`.`location_id` INNER JOIN 
        `city` ON city.`id`=location.`city_id` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' ;");
        $ad = $addres->fetch_assoc();
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>eShop invoice</title>
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

        <body id="body" class="mt-2" style="background-color: #f7f7ff;">
        <?php
        require "loading.php";
        ?>
        <div id="editor"></div>
            <div class="container-fluid">
                <div class="row">

                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 btn-toolbar justify-content-end">
                        <button class="btn btn-dark me-2" onclick="printDiv()">Print <i class="bi bi-printer-fill"></i></button>
                        <button class="btn btn-danger me-2" id="cmd" >Save as PDF <i class="bi bi-file-earmark-pdf-fill"></i></button>
                    </div>
                    <div id="page">
                        <div class="col-12"> 
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="invoiceheaderimg"></div>
                                </div>


                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 text-decoration-underline text-primary text-end fw-bold">
                                            <h2>eShop</h2>
                                            <div class="col-12 text-end fw-bold">
                                                <span>Maradana,Colombo 10,Sri Lanka</span><br />
                                                <span>+94123469784</span><br />
                                                <span>eshop@gmail.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border border-1 border-primary" />

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5>INVOICE TO : </h5>
                                    <h2><?php echo $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"] ?></h2>
                                    <span class="fw-bold"><?php echo $ad["line1"] . "," . $ad["line1"] . "," . $ad["name"] ?></span><br />
                                    <span class="fw-bold text-primary text-decoration-underline"><?php echo $_SESSION["user"]["email"] ?></span>
                                </div>
                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE 0<?php echo $t["id"] ?></h1>
                                    <span class="fw-bold">Date and Time Of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $t["date"] ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="border border-1 border-white">
                                        <th>#</th>
                                        <th>Order Id and Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < $nr; $i++) {

                                        $det = $invoice->fetch_assoc();

                                        $pro = database::s("SELECT * FROM `product` WHERE `id`= '" . $det["product_id"] . "';");
                                        $product = $pro->fetch_assoc();
                                        $subtot = $subtot + $det["total"]
                                    ?>
                                        <tr style="height:70px;">
                                            <td class="bg-primary text-white fs-3"><?php echo $i + 1 ?></td>
                                            <td>
                                                <a href="#" class="fs-6 fw-bold p-2"><?php echo $det["order_id"] ?></a><br />
                                                <a href="#" class="fs-6 fw-bold p-2"><?php echo $product["title"] ?></a>
                                            </td>
                                            <td class="fs-6 text-end pt-3" style="background-color: rgb(199,199,199);">Rs.<?php echo $product["price"] ?></td>
                                            <td class="fs-6 text-end pt-3"><?php echo $det["qty"] ?></td>
                                            <td class="fs-6 text-end pt-3 bg-primary text-white"><?php echo $det["total"] ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>





                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                        <td class="fs-5 text-end"><?php echo $subtot ?></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="fs-5 text-end border-primary">Discount</td>
                                        <td class="fs-5 text-end border-primary">Rs. 0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="fs-4 text-end border-0 text-primary">Grandtotal</td>
                                        <td class="fs-5 text-end border-0 text-primary">Rs. <?php echo $subtot - $dis ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-center col-4" style="margin-top: -100px ;margin-bottom: 50px;">
                            <span class="fs-1">Thank You</span>
                        </div>

                        <div style="background-color:#e7f2ff;" class="col-12 mt-3 mb-3 border border-end-0 border-top-0 border-bottom-0 border-5 rounded border-primary ">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-6 fw-bold">NOTICE : </label>
                                    <label class="form-label fs-6 fw-bold">Purchased items can return before 7 days of delivery. </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 mb-3 text-center ">
                            <label class="form-label f-6 text-black-50">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>
                    </div>



































                    <?php
                    require "footer.php";
                    ?>

                </div>
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
} else {
    header("location:home.php");
}
?>