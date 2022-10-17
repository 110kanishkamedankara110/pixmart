<?php
session_start();
require "database.php";
if (isset($_GET["to"])) {

    $to = $_GET["to"];
} else {
    $to = "";
}
$_SESSION["selctuser"] = $to;


if (isset($_SESSION["user"])) {


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>PiXMart Masages</title>
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

    <body onload="refresh();" style="background-color: #74ebd5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">
    <?php
        require "loading.php";
        ?>
        <div class="container-fluid">
            <div class="row">
                <?php
                require "header.php"
                ?>
<nav>
                                                        <ol class=" d-flex flex-wrap mb-0 mt-3 list-unstyled bg-white rounded">
                                                            <li class="breadcrumb-item ">
                                                                <a href="home.php">Home</a>
                                                            </li>

                                                            <li class="breadcrumb-item active">
                                                                <a class="text-decoration-none text-black-50" href="#">Massage</a>
                                                            </li>
                                                        </ol>
                                                    </nav>
                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row  rounded overflow-hidden shadow">
                        <div class="col-12 h-50 h-lg-100 col-lg-5 px-0">
                            <div class="bg-white">

                                <div class="bg-light px-4 py-2">
                                    <h5 class="mb-0 py-1">Recent</h5>
                                </div>

                                <div class="masage-box " id="massagebox">
                                    <div class="list-group rounded-0">
                                        <?php
                                        $cres = database::s("SELECT DISTINCT `chat_id` FROM `Chat` WHERE `from`='" . $_SESSION["user"]["email"] . "' OR `to`='" . $_SESSION["user"]["email"] . "'; ");
                                        $crnum = $cres->num_rows;
                                        for ($i = 0; $i < $crnum; $i++) {
                                            $chatid = $cres->fetch_assoc();
                                            $resenres = database::s("SELECT * FROM `chat` WHERE `chat_id`='" . $chatid["chat_id"] . "'   ORDER BY `date` DESC  ;");
                                            $resent = $resenres->fetch_assoc();

                                            if ($resent["from"] == $_SESSION["user"]["email"]) {
                                                $user = database::s("SELECT * FROM `user` WHERE `email`='" . $resent["to"] . "'");
                                                $u = $user->fetch_assoc();
                                        ?>
                                                <a onclick="seluser('<?php echo $resent['to'] ?>');refresh();" class="mt-1 list-group-item list-group-item-action  rouded-0 bg-primary text-white">
                                                    <div class="media">
                                                        <img src="<?php echo $u["image"] ?>" width="50px" height="50px" class="rounded-circle" />
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                <h6 class="mb-0"><?php echo $u["first_name"] . " " . $u["last_name"] ?></h6>
                                                                <small class="fw-bold">01-10</small>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0"><?php echo $resent["content"] ?></p>
                                                    </div>

                                                </a>
                                            <?php
                                            } else {
                                                $user = database::s("SELECT * FROM `user` WHERE `email`='" . $resent["from"] . "'");
                                                $u = $user->fetch_assoc();
                                            ?>
                                                <a onclick="seluser('<?php echo $resent['from'] ?>');refresh();" class="mt-1 list-group-item list-group-item-action  rouded-0 bg-primary text-white">
                                                    <div class="media">
                                                        <img src="<?php echo $u["image"] ?>" width="50px" height="50px" class="rounded-circle" />
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                <h6 class="mb-0"><?php echo $u["first_name"] . " " . $u["last_name"] ?></h6>
                                                                <small class="fw-bold">01-10</small>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0"><?php echo $resent["content"] ?></p>
                                                    </div>

                                                </a>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <!-- <a href="#" class="mt-1 list-group-item list-group-item-action  rouded-0 bg-primary text-white">
                                            <div class="media">
                                                <img src="recourses\demoProfileImg.jpg" width="50px" class="rounded-circle" />
                                                <div class="mb-4">
                                                    <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                        <h6 class="mb-0">Kamal</h6>
                                                        <small class="fw-bold">01-10</small>
                                                    </div>
                                                </div>
                                                <p class="mb-0">hi.....</p>
                                            </div>
                                           
                                        </a> -->

                                    </div>

                                </div>




                            </div>
                        </div>

                        <div class="col-lg-7 col-12 p-0">
                            <div class="row px-4 text-white">

                                <div class="col-12 p-3" id="chatbox" style="height: 500px;overflow-y: auto;">
                                        <!-- <div class="row">
                                            <div class="text-start">
                                            <img src="recourses\demoProfileImg.jpg" width="50px" height="50px" class=" mb-3 rounded-circle">
                                                <label class=" p-2 rounded bg-primary">
                                                    
                                                </label>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="text-end">
                                            
                                                <label class=" p-2 rounded bg-primary">
                                                    
                                                </label>
                                                <img src="recourses\demoProfileImg.jpg" width="50px" height="50px" class=" mb-3 rounded-circle">
                                            </div>
                                        </div> -->
                                    <!--sender's massage-->
                                    <!-- <div class="media mb-3 w-50">
                                    <img src="recourses\demoProfileImg.jpg" width="50px" class=" mb-3 rounded-circle">
                                    <div class="media-body me-3 ">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="mb-0 text-black-50">hi jdfd jd kldxdk isds se ij fsf t</p>
                                        </div>
                                        <p class="small text-black-50 text-end"> 08:45:33 | 1.10.2021</p>
                                    </div>
                                </div> -->




                                    <!--sender's massage-->

                                    <!--reciver's massage-->

                                    <!-- <div class="media w-50 mb-3">
                                    <div class="media-body ">
                                        <div class="bg-primary rounded py-2 px-3 mb-2">
                                            <p class="mb-0 text-white">sdof sdf sdfksokfr bvc.,bcjy dkgdsp </p>
                                        </div>
                                        <p class="small text-black-50 text-end"> 08:45:33 | 1.10.2021</p>

                                    </div>
                                </div> -->








                                    <!--reciver's massage-->
                                    
                                </div>
                                <!--text-->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-11">
                                            <input id="ms" class="form-control  py-3  bg-light rounded-3 border-0   " type="text"  placeholder="Type a massage.." />
                                        </div>
                                        <div class="col-1 d-grid">
                                            <button onclick="sendmassage();" id="sendbutton" class="btn btn-dark"><i class="bi bi-cursor-fill"></i></button>

                                        </div>
                                    </div>
                                </div>
                                <!--text-->
                            </div>

                        </div>






                    </div>
                </div>
















































                <?php
                require "footer.php"
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
?>