<?php
session_start();
$us = $_POST["us"];
// echo $_SESSION["selctuser"];

require "database.php";

$userimgg = database::s("SELECT * FROM `user` WHERE `email`='" . $us . "'");
$seluimg = $userimgg->fetch_assoc();
if ($seluimg["image"] == "NULL") {
    $im = "recourses\demoProfileImg.jpg";
} else {
    $im = $seluimg["image"];
}
$adminimgg = database::s("SELECT * FROM `user` WHERE `email`='" . $_SESSION["admin"]["email"] . "'");
$selaimg = $adminimgg->fetch_assoc();
if ($selaimg["image"] == "NULL") {
    $aim = "recourses\demoProfileImg.jpg";
} else {
    $aim = $selaimg["image"];
}
$chats = database::s("SELECT * FROM `chat` WHERE (`to`='" . $_SESSION["admin"]["email"] . "' AND `from`='" . $us . "' ) OR (`to`='" . $us . "' AND `from`='" . $_SESSION["admin"]["email"] . "' ) ORDER BY `date` ASC ; ");
$nr = $chats->num_rows;
for ($i = 0; $i < $nr; $i++) {
    $ch = $chats->fetch_assoc();
    if ($ch["to"] == $us) {
?>
        <!--Sender's massage-->

        <div class="row">
            <div class="text-end">

                <label class=" p-2 rounded bg-primary">
                    <?php echo $ch["content"] ?>
                </label>
                <img src="<?php echo $aim ?>" width="50px" height="50px" class=" mb-3 rounded-circle">
            </div>
            <p class="small text-black-50 text-end"><?php
                                                    $tim = explode(" ", $ch["date"]);
                                                    echo $tim[1] . " | " . $tim[0]

                                                    ?>
            </p>
        </div>









        <!--reciver's massage-->
    <?php
    } else {
    ?>
        <!--sender's massage-->
        <div class="row">
            <div class="text-start">
                <img src="<?php echo $im ?>" width="50px" height="50px" class=" mb-3 rounded-circle">
                <label class=" p-2 rounded bg-dark text-white"><?php echo $ch["content"] ?>
                </label>
            </div>
            <p class="small text-black-50 text-start"><?php
                                                        $tim = explode(" ", $ch["date"]);
                                                        echo $tim[1] . " | " . $tim[0]

                                                        ?>
            </p>
        </div>



<?php
    }
}
?>
?>