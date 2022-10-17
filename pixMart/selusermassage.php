<?php
session_start();
if (isset($_POST["user"])) {

    $_SESSION["selctuser"] = $_POST["user"];
}
// echo $_SESSION["selctuser"];

require "database.php";
$user=database::s("SELECT * FROM `user` WHERE `email`='".$_SESSION["selctuser"]."'");
$seluimg=$user->fetch_assoc();
if($seluimg["image"]=="NULL"){
    $im="recourses\demoProfileImg.jpg";
}else{
    $im=$seluimg["image"];
}
$chats = database::s("SELECT * FROM `chat` WHERE (`to`='" . $_SESSION["user"]["email"] . "' AND `from`='" . $_SESSION["selctuser"] . "' ) OR (`to`='" . $_SESSION["selctuser"] . "' AND `from`='" . $_SESSION["user"]["email"] . "' ) ORDER BY `date` ASC ; ");
$nr = $chats->num_rows;
for ($i = 0; $i < $nr; $i++) {
    $ch = $chats->fetch_assoc();
    if ($ch["to"] == $_SESSION["selctuser"]) {
?>
        <!--Sender's massage-->

        <div class="row">
            <div class="text-end">

                <label class=" p-2 rounded bg-primary">
                    <?php echo $ch["content"] ?>
                </label>
                <img src="<?php echo $_SESSION["user"]["image"]?>" width="50px" height="50px" class=" mb-3 rounded-circle">
            </div>
            <p class="small text-black-50 text-end"><?php
                                                    $tim = explode(" ", $ch["date"]);
                                                    echo $tim[1] . " | " . $tim[0]

                                                    ?>
            </p>
        </div>
        <!-- <div class=" w-50 mb-3 ">
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
        </div><br /> -->








        <!--reciver's massage-->
    <?php
    } else {
    ?>
        <!--sender's massage-->
        <div class="row">
            <div class="text-start">
                <img src="<?php echo $im?>" width="50px" height="50px" class=" mb-3 rounded-circle">
                <label class=" p-2 rounded bg-white text-dark"><?php echo $ch["content"] ?>
                </label>
            </div>
            <p class="small text-white text-start"><?php
                                                    $tim = explode(" ", $ch["date"]);
                                                    echo $tim[1] . " | " . $tim[0]

                                                    ?>
            </p>
        </div>


        <!-- <div class="media mb-3 w-50 d-block">
            <img src="recourses\demoProfileImg.jpg" width="50px" height="50px" class=" mb-3 rounded-circle">
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
        </div><br /> -->




        <!--sender's massage-->
<?php
    }
}
?>