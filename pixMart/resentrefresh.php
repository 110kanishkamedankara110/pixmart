<?php

session_start();
require "database.php";
?>
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