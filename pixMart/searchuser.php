<?php
$s = $_POST["search"];
require "database.php";
$search = $s . "%";

session_start();
?>
<?php



$user = database::s("SELECT * FROM `user` WHERE `email` LIKE '" . $search . "' ; ");
$un = $user->num_rows;

for ($p = 0; $p < $un; $p++) {
    $us = $user->fetch_assoc();

?>

    <?php

    ?>


    <div class="col-12 mt-3 mb-2">
        <div class="row">
            <div class="col-2 col-lg-1 bg-info pt-2 pb-2 text-end">
                <span class="fs-5 fw-bold text-white"><?php echo $p + 1; ?></span>
            </div>
            <div onclick="viewmassagemodel('<?php echo $us['email'] ?>');" class="col-2 bg-light d-none d-lg-block">
                <img src="<?php echo $us["image"] ?>" alt="" style="height: 70px; margin-left: 70px;">
            </div>
            <div class="col-6 col-lg-2 bg-primary pt-2 pb-2 text-center">
                <span class="fs-5 fw-bold text-white"><?php echo $us["email"] ?></span>
            </div>
            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold"><?php echo $us["first_name"] . " " . $us["last_name"] ?></span>
            </div>
            <div class="col-2 bg-primary pt-2 pb-2 text-center d-none d-lg-block">
                <span class="fs-5 fw-bold text-white"><?php echo $us["mobile"] ?></span>
            </div>
            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold"><?php echo explode(" ", $us["register_date"])["0"];    ?></span>
            </div>
            <div class="col-4 col-lg-1 bg-white pt-2 pb-2 d-grid">
                <?php
                if ($us["status"] == "1") {
                ?>
                    <button id="btn<?php echo $us['email'] ?>" class="btn btn-danger" onclick="blockuser('<?php echo $us['email'] ?>');">Block</button>
                <?php
                } else {
                ?>
                    <button id="btn<?php echo $us['email'] ?>" class="btn btn-success" onclick="blockuser('<?php echo $us['email'] ?>');">Unblock</button>
                <?php
                }

                ?>

            </div>
        </div>
    </div>
    <!--model-->


    <div class="modal fade" id="massageModal<?php echo $us["email"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send Massage To <?php echo $us["first_name"] . " " . $us["last_name"] ?> </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!--massage-->
                                    <div class="col-12 py-5 px-4">
                                        <div class="row  rounded overflow-hidden shadow">
                                            <div class="col-12 px-0">
                                                <div class="bg-white">

                                                    <!-- <div class="bg-light px-4 py-2">
                                                        <h5 class="mb-0 py-1">Recent</h5>
                                                    </div>

                                                    <div class="masage-box">
                                                        <div class="list-group rounded-0">
                                                            <a href="#" class="list-group-item list-group-item-action  rouded-0 bg-primary text-white">
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

                                                            </a>
                                                        </div>
                                                    </div> -->



                                                </div>
                                            </div>

                                            <div class="col-12 p-0" >
                                                <div id="chatbox<?php echo $us["email"] ?>">

                                                    <?php
                                                    $chats = database::s("SELECT * FROM `chat` WHERE (`to`='" . $_SESSION["admin"]["email"] . "' AND `from`='" . $us["email"] . "' ) OR (`to`='" . $us["email"] . "' AND `from`='" . $_SESSION["admin"]["email"] . "' ); ");

                                                    $nr = $chats->num_rows;
                                                    for ($i = 0; $i < $nr; $i++) {
                                                        $ch = $chats->fetch_assoc();
                                                        if ($ch["from"] == $us["email"]) {
                                                    ?>
                                                            <!--reciver's massage-->

                                                            <div class="media w-50 mb-3 ">
                                                                <div class="media-body ">
                                                                    <div class="bg-primary rounded py-2 px-3 mb-2">
                                                                        <p class="mb-0 text-white"><?php echo $ch["content"] ?> </p>
                                                                    </div>
                                                                    <p class="small text-black-50 text-end"><?php
                                                                                                            $tim = explode(" ", $ch["date"]);
                                                                                                            echo $tim[1] . " | " . $tim[0]

                                                                                                            ?>
                                                                    </p>

                                                                </div>
                                                            </div><br />








                                                            <!--reciver's massage-->
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <!--sender's massage-->
                                                            <div class="media mb-3 w-50 d-block">
                                                                <img src="recourses\demoProfileImg.jpg" width="50px" class=" mb-3 rounded-circle">
                                                                <div class="media-body me-3 ">
                                                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                                                        <p class="mb-0 text-dark"><?php echo $ch["content"] ?> </p>
                                                                    </div>
                                                                    <p class="small text-white text-end"><?php
                                                                                                            $tim = explode(" ", $ch["date"]);
                                                                                                            echo $tim[1] . " | " . $tim[0]

                                                                                                            ?>
                                                                    </p>
                                                                </div>
                                                            </div><br />




                                                            <!--sender's massage-->
                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                </div>


                                                <!--text-->
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="input-group">
                                                            <input id="ms<?php echo  $us['email'] ?>" class="form-control  py-4 bg-light rounded-0 border-0   " type="text" aria-describedby="sendbutton" placeholder="Type a massage.." />
                                                            <div class="input-grou-append">
                                                                <button id="sendbutton" onclick="sendmassage2('<?php echo  $us['email'] ?>');" class="btn btn-link fs-3"><i class="bi bi-cursor-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--text-->
                                            </div>

                                        </div>






                                    </div>
                                </div>















                                <!--massage-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
            </div>

    <!--model-->
<?php
}


?>