<?php
session_start();
if (!isset($_SESSION["admin"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart Admin Signin</title>
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

    <body class="bgbg">
        <?php
        require "loading.php";
        ?>
        <div class="container-fluid justify-content-center" style="margin-top: 190px;">
            <div class="row align-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 logologo"></div>
                        <div class="col-12">
                            <h1 class="text-center title1 fw-bolder text-white">Hi, Welcome To PiXMart </h1>
                        </div>
                    </div>
                </div>

                <div class="col-12 p-5">
                    <div class="row">
                        <div class="col-6 d-none d-lg-block background1"></div>
                        <div class="col-12 col-lg-6 d-block">
                            <div class="row g-3">
                                <div class="col-12 text-white">
                                    <p>Sign In To Your Account</p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-white">Email</label>
                                    <input id="e" type="email" class="form-control">
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button onclick="adminverification();" class="btn btn-primary">Send Verification code to your account</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="index.php" class="btn btn-danger">Back to User's Log In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-none d-lg-block fixed-bottom">
                    <p class="text-center">&copy; 2021 PiXMart.lk ALL Rights Reserved.</p>
                </div>

            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="VerificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin Verification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Enter Verification Code You Recieved</label>
                        <input id="v" type="text" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="Verify();" class="btn btn-primary">Verify</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->






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
?>
    <script>
        window.location = "adminpannel.php"
    </script>
<?php
}
?>