<?php
session_start();
require "database.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title> PiXMart Advanced search</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="recourses\logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body class="bg-info">
    <?php
    require "loading.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-white border border-start-0 border-end-0 border-top-0 border-primary ">
                <?php
                require "header.php"
                ?>
            </div>
            <div class="col-12 bg-white">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2 mt-2">
                                <div class=" mb-3 selogo"></div>

                            </div>
                            <div class="col-10">
                                <label class="text-black-50 fw-bold fs-2 mt-4">Advanced Search</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="offset-0 offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" id="k" class="form-control fw-bold" placeholder="Type Keyword To Search">
                            </div>
                            <div class="col-12 col-lg-2 mt-3 mb-2">
                                <button class="btn btn-primary sb1 " onclick="advsearch('1');">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-12 mb-3">
                                        <select id="c" class="form-select">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $cat = database::s("SELECT * FROM `category`;");
                                            $catn = $cat->num_rows;
                                            for ($i = 0; $i < $catn; $i++) {
                                                $catagory = $cat->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $catagory["id"] ?>"><?php echo $catagory["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-12 mb-3">
                                        <select id="b" class="form-select">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $bra = database::s("SELECT * FROM `brand`;");
                                            $bran = $bra->num_rows;
                                            for ($i = 0; $i < $bran; $i++) {
                                                $brand = $bra->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand["id"] ?>"><?php echo $brand["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-12 mb-3">
                                        <select id="m" class="form-select">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $mod = database::s("SELECT * FROM `model`;");
                                            $modn = $mod->num_rows;
                                            for ($i = 0; $i < $modn; $i++) {
                                                $model = $mod->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model["id"] ?>"><?php echo $model["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="con" class="form-select">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $con = database::s("SELECT * FROM `condition`;");
                                            $conn = $con->num_rows;
                                            for ($i = 0; $i < $conn; $i++) {
                                                $condition = $con->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition["id"] ?>"><?php echo $condition["condition"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <select id="colo" class="form-select">
                                            <option value="0">Select color</option>
                                            <?php
                                            $col = database::s("SELECT * FROM `color`;");
                                            $coln = $col->num_rows;
                                            for ($i = 0; $i < $coln; $i++) {
                                                $color = $col->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color["id"] ?>"><?php echo $color["name"] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <input id="pf" type="text" class="form-control" placeholder="Price From" />
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <input id="pt" type="text" class="form-control" placeholder="Price To" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3 bg-white rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="disp">


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div>
        <?php
        require "footer.php"

        ?>
    </div>









    </div>
    </div>



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</body>

</html>