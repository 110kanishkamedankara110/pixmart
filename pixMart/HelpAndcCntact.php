<?php
session_start();
if (isset($_SESSION["user"])) {
    require "database.php";
    $cart = database::s("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["user"]["email"] . "';");
    $cpronr = $cart->num_rows;
    $totprice = 0;
    $totship = 0;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart Contact</title>
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


    <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
        <footer style="background-color:rgba(94, 32, 94, 0.879) ;" class=" text-white pt-5 pb-4">
            <div class="col-12 text-center text-md-start">
                <div class="row text-center text-md-start">
                    
                    <div class="col-12 col-md-4 col-lg-3 mx-auto mt-3">
                        <h5 class="text-warning text-uppercase mb-4">contact</h5>
                        <p>
                            <i class="bi bi-house-fill pe-1"></i> Kandy,Kandy 10,Sri Lanka
                        </p>
                        <p>
                            <i class="bi bi-envelope-fill pe-1"></i> pixbin@gmail.com
                        </p>
                        <p>
                            <i class="pe-1 bi bi-telephone-fill "></i>+94 705715007
                        </p>
                        <p>
                            <i class="pe-1 bi bi-printer-fill"></i>+94 705715007
                        </p>

                    </div>
                </div>
                <hr class="mb-4" />
            </div>
            

        </footer>
        <div class="col-6 offset-3 background1 d-none d-lg-block order-2" style="height:450px">

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
    header("location:index.php");
}
