<?php
session_start();
if(isset($_SESSION["user"])){
    ?>
    <!DOCTYPE html>
<html>

<head>
    <title>PiXMart | Add Product</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="recourses\logo.svg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
<?php
        require "loading.php";
        ?>
    <div class="container-fluid">
        <div class="row">

            <!--addproduct-->
            <div id="addproductbox">
                <!--heading-->
                <div class="col-12 mb-3">
                    <h3 class="h2 text-center" style="color: purple;">Product Listing</h3>
                </div>
                
                <div class="col-12" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Listiong</li>
                        </ol>
                    </nav>
                </div>
                <!--heading-->

                <!--category,brand,model-->

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Catagory</label>
                                </div>
                                <div class="col-12 mb-3">

                                    <select class="form-select" id="ca">
                                        <option>Select Chatagory</option>
                                        <?php
                                        require "database.php";
                                        $result = database::s("SELECT * FROM `category`");
                                        $n = $result->num_rows;
                                        for ($i = 0; $i < $n; $i++) {
                                            $r = $result->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $r["id"] ?>"><?php echo $r["name"] ?></option>



                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Brand</label>
                                </div>
                                <div class="col-12 mb-3">
                                    <select class="form-select" id="br">
                                        <option>Select Brand</option>
                                        <?php

                                        $resbrand = database::s("SELECT * FROM `brand`");
                                        $nr = $resbrand->num_rows;
                                        for ($x = 0; $x < $nr; $x++) {
                                            $resb = $resbrand->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $resb["id"] ?>"><?php echo $resb["name"] ?></option>



                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Select Product Model</label>
                                </div>
                                <div class="col-12 mb-3">

                                    <select class="form-select" id="mo">
                                        <option>Select Model</option>
                                        <?php

                                        $resmodel = database::s("SELECT * FROM `model`");
                                        $nm = $resmodel->num_rows;
                                        for ($z = 0; $z < $nm; $z++) {
                                            $resm = $resmodel->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $resm["id"] ?>"><?php echo $resm["name"] ?></option>



                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>





                <!--category,brand,model-->

                <hr class="hrbreak1" />

                <!--title-->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <lable class="form-label lbl1">Add a Title To Your Product</lable>
                        </div>
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <input type="text" class="form-control mb-3" id="ti" />
                        </div>
                    </div>
                </div>

                <!--title-->

                <hr class="hrbreak1" />

                <!--condition,color,qty-->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <lable class="form-label lbl1">Select Product Condition</lable>
                                </div>
                                <div class="form-check offset-1  col-12 col-lg-3">
                                    <input checked class="form-check-input" type="radio" name="flexRadioDefault" id="bn">
                                    <label class="form-check-label" for="bn">
                                        Brandnew
                                    </label>
                                </div>
                                <div class="form-check offset-1 offset-lg-0 col-12 col-lg-3 mb-3">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="us">
                                    <label class="form-check-label" for="us">
                                        Used
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <lable class="form-label lbl1">Select Product Color</lable>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-lg-4 col-5 offset-1 form-check">
                                            <input checked class="form-check-input" type="radio" name="flexRadioDefault2" id="clr1">
                                            <label class="form-check-label" for="clr1">
                                                Gold
                                            </label>
                                        </div>

                                        <div class="col-lg-4 offset-0 col-5 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="clr2">
                                            <label class="form-check-label" for="clr2">
                                                Silver
                                            </label>
                                        </div>
                                        <div class="col-lg-4 offset-1 col-5 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="clr3">
                                            <label class="form-check-label" for="clr3">
                                                Graphite
                                            </label>
                                        </div>
                                        <div class="col-lg-4 offset-0 col-5 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="clr4">
                                            <label class="form-check-label" for="clr4">
                                                Pacific Blue
                                            </label>
                                        </div>
                                        <div class="col-lg-4 offset-1 col-5 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="clr5">
                                            <label class="form-check-label" for="clr5">
                                                Rose Gold
                                            </label>
                                        </div>
                                        <div class="col-lg-4 offset-0 col-5 form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault2" id="clr6">
                                            <label class="form-check-label" for="clr6">
                                                Jet Black
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <lable class="form-label lbl1">Add Product Quantity</lable>
                                    <input type="number" class="form-control" value="0" min="0" id="qty">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--condition,color,qty-->
                <hr class="hrbreak1" />

                <!--cost,payment-->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <lable class="form-label lbl1">Cost Per Item</lable>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" id="cost" aria-label="Amount (to the nearest rupee)">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <lable class="form-label lbl1">Approved Payment Method</lable>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="pm1 col-2 offset-2"></div>
                                        <div class="pm2 col-2"></div>
                                        <div class="pm3 col-2"></div>
                                        <div class="pm4 col-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--cost,payment-->
                <hr class="hrbreak1" />
                <!--delivery cost-->
                <div class="col-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <lable class="form-label lbl1">Delivery Cost</lable>
                        </div>
                        <div class="col-12 offset-lg-1 col-lg-3">
                            <lable class="form-lablle">Delivery Cost Within Colombo</lable>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input id="dwc" type="text" class="form-control" aria-label="Amount (to the nearest rupee)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <lable class="form-label lbl1"></lable>
                        </div>
                        <div class="col-12 offset-lg-1 col-lg-3 mt-lg-4">
                            <lable class="form-lablle">Delivery Cost Out Of Colombo</lable>
                        </div>
                        <div class="col-12 col-lg-7 mt-lg-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rs.</span>
                                <input id="doc" type="text" class="form-control" aria-label="Amount (to the nearest rupee)">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>



                <!--delivery cost-->
                <hr class="hrbreak1" />

                <!--product description-->
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <lable class="form-label lbl1">Product Description</lable>
                        </div>
                        <div class="col-12">
                            <textarea id="des" class="form-control" style="background-color: whitesmoke;"></textarea>
                        </div>
                    </div>
                </div>
                <!--product description-->
                <hr class="hrbreak1" />
                <!--product image-->
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <lable class="form-label lbl1">Add Product Image</lable>
                        </div>
                        <div id="iii">
                            <img class="productimg col-4 col-lg-2 ms-2" id="prev" src="recourses\add product page resources\addproductimg.svg" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 ms-2 mt-2 col-lg-6" id="imd">
                                    <input multiple type="file" accept="image/*" class="d-none" id="imguploader" enctype="multipart/form-data" />
                                    <label for="imguploader" class="btn btn-primary col-6 col-lg-8" onclick="changeimage();">Upload</label>
                                </div>
                                <!-- <div class="col-6 col-lg-4 d-grid mt-2 mt-lg-0">
                                <button class="btn btn-primary">Upload</button>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--product image-->
                <hr class="hrbreak1" />
                <!--notice-->
                <div class="col-12 mb-3">
                    <lable class="form-label lbl1">Notice....</lable><br />
                    <lable class="form-label">We are Taking 5% of the product price from ecery product as a service charge.</lable>
                </div>
                <!--notice-->

                <!--save button-->
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                    <a href="updateproduct.php" class="btn btn-dark searchbutton" >Update Product</a>
                </div>
                <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                    <button class="btn btn-success searchbutton" onclick="addproduct();">Add Product</button>
                </div>
                
                <!--save button-->


                <!--footer-->
                <?php
                require "footer.php";
                ?>
            </div>
            <!--addproduct-->

            



        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>
    <?php

}else{
    header("location:index.php");
}




?>










