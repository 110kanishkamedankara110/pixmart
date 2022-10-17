<?php

session_start();
require "database.php";
if (isset($_SESSION["user"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart User Profile</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="recourses\logo.svg" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


    </head>

    <body class="bg-dark" style="overflow-x: hidden;">
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid bg-white rounded mt-5 mb-5 ">
            <div class="row">
            <nav>
                            <ol class=" d-flex flex-wrap mb-2 mt-2 list-unstyled bg-white rounded">
                                <li class="breadcrumb-item ">
                                    <a href="home.php">Home</a>
                                </li>

                                <li class="breadcrumb-item active">
                                    <a class="text-decoration-none text-black-50" href="#">My Profile</a>
                                </li>
                            </ol>
                        </nav>
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        
                        <span class="font-weight-bold"><?php echo $_SESSION["user"]["user_email"]  ?></span>
                        <span class="text-black-50"><?php echo $_SESSION["user"]["email"] ?></span>
                        <input onchange="chimg();" type="file" accept="image/*" class="d-none" id="profileimage" enctype="multipart/form-data" />
                        <label class="btn btn-primary mt-3" for="profileimage" style="background-color: purple;">Update profile Image</label>


                    </div>
                </div>
                <div class="col-md-7 border-right bg-dark text-white mb-3 rounded-3">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>

                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input id="fname" type="text" class="form-control" placeholder="First Name" value="<?php echo $_SESSION["user"]["first_name"] ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input id="lname" type="text" class="form-control" placeholder="Last Name" value="<?php echo $_SESSION["user"]["last_name"] ?>" />
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control" placeholder="Mobile Number" value="<?php echo $_SESSION["user"]["mobile"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable class="form-label">Password</lable>
                                <input id="" disabled type="text" class="form-control" placeholder="Password" value="<?php echo $_SESSION["user"]["password"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable class="form-label">Email</lable>
                                <input disabled id="email" type="email" class="form-control" placeholder="Email Address" value="<?php echo $_SESSION["user"]["email"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <lable class="form-label">Registred Date And Time</lable>
                                <input disabled type="text" class="form-control" placeholder="Registred Date And Time" value="<?php echo $_SESSION["user"]["register_date"] ?>" />
                            </div>
                            <?php
                            $usermail = $_SESSION["user"]["email"];

                            $address = database::s("SELECT * FROM `user_has_address` WHERE `user_email`='" . $usermail . "'; ");
                            $n = $address->num_rows;
                            if ($n == 1) {
                                $row = $address->fetch_assoc();
                            ?>
                                <div class="col-md-12 mb-3">
                                    <lable class="form-label">Address Line 1</lable>
                                    <input  id="addressline1" type="text" class="form-control" placeholder="Address Line 1" value="<?php echo $row["line1"] ?>" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <lable class="form-label">Address Line 2</lable>
                                    <input id="addressline2" type="text" class="form-control" placeholder="Address Line 2" value="<?php echo $row["line2"] ?>" />
                                </div>
                        </div>

                    <?php
                            } else {
                    ?>
                        <div class="col-md-12 mb-3">
                            <lable class="form-label">Address Line 1</lable>
                            <input id="addressline1" type="text" class="form-control" placeholder="Address Line 1" value="" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <lable class="form-label">Address Line 2</lable>
                            <input type="text" id="addressline2" class="form-control" placeholder="Address Line 2" value="" />
                        </div>
                    </div>

                <?php
                            }







                ?>
                <?php

                $city = database::s("SELECT * FROM `user_has_address` INNER JOIN `location` ON 
                            `user_has_address`.`location_id`=`location`.`id` INNER JOIN `city` ON `city`.`id`=`location`.`city_id` WHERE `user_has_address`.`user_email`='" . $usermail . "';");
                $n2 = $city->num_rows;
                if ($n2 == 1) {
                    $row2=$city->fetch_assoc();
                ?>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <lable class="form-label">City</lable>
                            <select id="city" class="form-select" aria-selected="<?php echo $row2["name"];?>">
                            <option>Select City</option>
                                <?php
                                $citylist = database::s("SELECT * FROM `city`"); 
                                  $n5 = $citylist->num_rows;
                                for($c=0;$c<$n5;$c++){
                                    $f=$citylist->fetch_assoc();
                                    if($f["name"]==$row2["name"]){
                                        ?>
                                    <option selected><?php echo $f["name"]?></option>
                                    <?php
    
                                    }else{
                                        ?>
                                    <option><?php echo $f["name"]?></option>
                                    <?php

                                    }
                                                                    }
                                ?>

                                
                            </select>

                        </div>
                    <?php
                }else{
                    ?>
                    <div class="row mt-3">
                            <div class="col-md-6">
                                <lable class="form-label">City</lable>
                                <select id="city" class="form-select">
                                <option>Select City</option>
                                <?php
                                $citylist = database::s("SELECT * FROM `city`"); 
                                  $n5 = $citylist->num_rows;
                                for($c=0;$c<$n5;$c++){
                                    $f=$citylist->fetch_assoc();
                                    ?>
                                    <option><?php echo $f["name"]?></option>
                                    <?php
                                }
                                ?>

                                
                            </select>

                            </div>
                    <?php
                }



                    ?>





                    
                        <div class="col-md-6">
                            <?php
                                $gender=database::s("SELECT * FROM `gender` WHERE `gender`.`id`='".$_SESSION["user"]["gender_id"]."'; ");
                                $g=$gender->fetch_assoc();
                            ?>
                            <lable class="form-label">Gender</lable>
                            <input type="text" disabled class="form-control" placeholder="Gender" value="<?php echo $g["name"];?>" />

                        </div>
                        <div class="mt-5 text-center">
                            <button class=" btn btn-primary" style="background-color: purple;" onclick="updateprofile();" >Update Profile</button>
                        </div>
                    </div>


                    </div>

                </div>
                <!-- <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="col-md-12">
                            <span class="heading">User Rating</span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4 text-warning"></span>
                            <span class="fa fa-star fs-4"></span>
                            <p>4.1 average based on 254 reviews</p>
                            <hr class="hrbreak1">
                            </hr>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="side">
                                <div>5 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>
                                <div class="text-end">150</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="side">
                                <div>4 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">30</div>
                        </div>
                        <div class="row">
                            <div class="side">
                                <div>3 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">230</div>
                        </div>
                        <div class="row">
                            <div class="side">
                                <div>2 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">50</div>
                        </div>
                        <div class="row">
                            <div class="side">
                                <div>1 Star</div>
                            </div>
                            <div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="text-end">40</div>
                        </div>


                    </div> 
                </div>-->
            </div>

        </div>

        <?php
        require "footer.php"
        ?>




























        <script src="script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>
<?php



} else {
    header("location:index.php");
}












?>