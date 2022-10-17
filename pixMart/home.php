<!-- <?php

        session_start();
        if (isset($_SESSION["user"])) {
        } else {
        }





        ?> -->
<!DOCTYPE html>
<html>

<head>
    <title>PiXMart Home</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="recourses\logo.svg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php
        require "loading.php";
        ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            require "header.php"
            ?>
            <hr class="hr1" />
            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="col-lg-1 col-12 logologo offset-lg-1"></div>
                    <div class="col-lg-6 col-12">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input id="basic_search_search" type="text" class="form-control" aria-label="Text input with dropdown button" />
                            <select class="form-select" id="basic_search_select">
                                <option value="0">Select Catagory</option>
                                <?php

                                require "database.php";
                                $result = database::s("SELECT * FROM `category`");
                                $n = $result->num_rows;
                                for ($i = 0; $i < $n; $i++) {
                                    $r = $result->fetch_assoc();

                                ?> <option value="<?php echo $r["id"] ?>"><?php echo $r["name"]; ?></option><?php
                                                                                                        }








                                                                                                            ?>
                                <!-- <li><a class="dropdown-item" href="#">Celphones and Accoserories</a></li>
                                <li><a class="dropdown-item" href="#">Computer and tablets</a></li>
                                <li><a class="dropdown-item" href="#">Cameras</a></li>
                                <li><a class="dropdown-item" href="#">Camera and Drons</a></li>
                                <li><a class="dropdown-item" href="#">Video Game Consoles</a></li> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-12 d-grid gap-2">
                        <button class="btn btn-primary mt-3 searchbutton" onclick="basic_search();" >Search</button>
                    </div>
                    <div class="col-12 col-lg-2 mt-4 " style="text-align: center;">
                        <a href="advane.php" class="link-secondary link1">Advanced</a>
                    </div>
                </div>
            </div>
            <hr class="hr1" />

            <!--slide-->


            <div class="col-12 d-none d-lg-block mb-3">
                <!-- <div class="row">
                    <div id="carouselExampleCaptions" class="carousel slide col-10 offset-1" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>

                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="recourses\slider images\posterimg.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Welcom To eShop</h5>
                                    <p>The World's best Store By One Click</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="recourses\slider images\posterimg2.jpg" class="d-block posterimg1" alt="..."> -->
                <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5 class="posttit">Second slide label</h5>
                                        <p class="posttex">Some representative placeholder content for the second slide.</p>
                                    </div> -->
                <!-- </div>
                            <div class="carousel-item">
                                <img src="recourses\slider images\posterimg3.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block " style="margin-top: 100px;">
                                    <h5 class="posttit" style="font-size: 30px;">Be Free......</h5>
                                    <p class="posttex" style="font-size: 25px;">Experience the lowest Delivery Cost With Us</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div> -->

                <div class="cont">
                    <div class="mouse"></div>
                    <div class="app shadow-none">
                        <div class="app__bgimg">
                            <div class="app__bgimg-image app__bgimg-image--1">
                            </div>
                            <div class="app__bgimg-image app__bgimg-image--2">
                            </div>
                        </div>
                        <div class="app__img">
                            <img onmousedown="return false" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/537051/whiteTest4.png" alt="city" />
                        </div>

                        <div class="app__text app__text--1">
                            <div class="app__text-line app__text-line--4">PiXMart </div>
                            <div class="app__text-line app__text-line--3">Lets Go Shopping</div>
                            <div class="app__text-line app__text-line--2"> </div>
                            <div class="app__text-line app__text-line--1"><img src="recourses\logo.svg" alt="" /></div>
                        </div>

                        <div class="app__text app__text--2">
                            <div class="app__text-line app__text-line--4">Exclusive Offers</div>
                            <div class="app__text-line app__text-line--3">Best Products</div>
                            <div class="app__text-line app__text-line--2"></div>
                            <div class="app__text-line app__text-line--1"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/537051/opus-attachment.png" alt="" /></div>
                        </div>
                        
                    </div>
                    <div class="pages">
                        <ul class='pages__list'>
                            <li data-target='1' class='pages__item pages__item--1 page__item-active'></li>
                            <li data-target='2' class='pages__item pages__item--2'></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
            <!--slide-->
            <div id="proview">
                <div class="row">
                    <!--product title view-->

                    <?php
                    $result2 = database::s("SELECT * FROM `category`");
                    $n2 = $result->num_rows;



                    for ($x = 0; $x < $n2; $x++) {
                        $c = $result2->fetch_assoc();
                    ?>

                        <?php
                        $respro = database::s("SELECT `product`.`id` AS `pid`,`price`,`date_time_added`,`status`.`name` AS `stat`,`qty`,`title` FROM `product` INNER JOIN `status` ON `status`.`id`=`product`.`status_id`  WHERE `category_id`='" . $c['id'] . "' AND  `status`.`name`='active'  ORDER BY `date_time_added` DESC LIMIT 4 ;");


                        $np = $respro->num_rows;
                        ?>
                        <div class="col-12">
                            <div class="row border border-dark mb-5 rounded-3 mx-3">
                                <div class="col-12" style="background-color:rgba(94, 32, 94, 0.879);color:white">
                                    <a class="link2" style="color:white"><?php echo $c["name"]; ?></a>&nbsp; &nbsp;
                                    <a onclick="showall(<?php echo $c['id']; ?>)" class="link3" style="cursor:pointer;color: white;">See All &rightarrow;</a>
                                </div>
                                <hr class="hr1" />
                                <div class="col-12 col-lg-12">
                                    <div class="row roun">
                                        <?php
                                        for ($y = 0; $y < $np; $y++) {
                                            $p = $respro->fetch_assoc();

                                            $res = database::s("SELECT * FROM `images`  WHERE `product_id`='" . $p["pid"] . "' ;");
                                            $ig = $res->fetch_assoc();
                                            if (isset($_SESSION["user"])) {
                                                $wl = database::s("SELECT * FROM `watchlist`  WHERE `product_id`='" . $p["pid"] . "' AND `user_email`='" . $_SESSION["user"]["email"] . "' ;");
                                                $nwl = $wl->num_rows;
                                            }







                                        ?>
                                            <div class="col-6 col-lg-2  card mt-1 mb-1 ms-1" style="width: 18rem;">
                                                <img src="<?php echo $ig["code"]; ?>" class="card-img-top cardTopImg">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $p["title"] ?>&nbsp;<span class="badge bg-primary">New</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $p["price"] ?> </span><br />

                                                    <?php
                                                    if ($p["qty"] > 0) {
                                                        if (isset($_SESSION["user"])) {
                                                            $h = "heart" . $p["pid"];
                                                    ?>
                                                            <span class="card-text text-warning">In Stock</span><br />
                                                            <input id="qty<?php echo $p['pid'] ?>" type="number" class="form-control mb-1" value="1" min="1" max="<?php echo $p["qty"] ?>" />
                                                            <a href="singleproductview.php?id=<?php echo $p["pid"]; ?>" class=" btn btn-success">Buy Now</a>
                                                            <a onclick="addtocart(<?php echo $p['pid'] ?>,<?php echo $p['qty'] ?>);" class="btn btn-danger">Add To Cart</a>
                                                            <?php
                                                            if ($nwl == 1) {
                                                            ?>
                                                                <a onclick="addwatchlist(<?php echo $p['pid'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart-fill"></i></a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a onclick="addwatchlist(<?php echo $p['pid'] ?>);" class="text-danger mt-1 fs-4" style="background-color: white;"><i id="<?php echo $h; ?>" class="bi bi-heart"></i></a>
                                                            <?php
                                                            }
                                                            ?>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="card-text text-warning">In Stock</span><br />
                                                            <!-- <input type="number" class="form-control mb-1" value="1" /> -->
                                                            <a href="singleproductview.php?id=<?php echo $p["pid"]; ?>" class=" btn btn-success">Buy Now</a>

                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <span class="card-text text-danger">Out Of Stock</span><br />
                                                        <input type="number" class="form-control mb-1" disabled value="0" />
                                                        <button disabled class="btn btn-success">Buy Now</button>
                                                        <button disabled class="btn btn-danger">Add To Cart</button>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }




                    ?>
                </div>
            </div>
            <!--footer-->
            <?php
            require "footer.php"
            ?>
            <!--footer-->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const $app = $('.app');
            const $img = $('.app__img');
            const $pageNav1 = $('.pages__item--1');
            const $pageNav2 = $('.pages__item--2');
            let animation = true;
            let curSlide = 1;
            let scrolledUp, nextSlide;

            let pagination = function(slide, target) {
                animation = true;
                if (target === undefined) {
                    nextSlide = scrolledUp ? slide - 1 : slide + 1;
                } else {
                    nextSlide = target;
                }

                $('.pages__item--' + nextSlide).addClass('page__item-active');
                $('.pages__item--' + slide).removeClass('page__item-active');

                $app.toggleClass('active');
                setTimeout(function() {
                    animation = false;
                }, 3000);
            };

            let navigateDown = function() {
                if (curSlide > 1) return;
                scrolledUp = false;
                pagination(curSlide);
                curSlide++;
            };

            let navigateUp = function() {
                if (curSlide === 1) return;
                scrolledUp = true;
                pagination(curSlide);
                curSlide--;
            };

            setTimeout(function() {
                $app.addClass('initial');
            }, 150);

            setTimeout(function() {
                animation = false;
            }, 450);

            $(document).on('mousewheel DOMMouseScroll', function(e) {
                var delta = e.originalEvent.wheelDelta;
                if (animation) return;
                if (delta > 0 || e.originalEvent.detail < 0) {
                    navigateUp();
                } else {
                    navigateDown();
                }
            });

            $(document).on("click", ".pages__item:not(.page__item-active)", function() {
                if (animation) return;
                let target = +$(this).attr('data-target');
                pagination(curSlide, target);
                curSlide = target;
            });
        });
    </script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>