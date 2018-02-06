<?php

require_once("config.php");
//Log the user out
if (isAdminLoggedIn()) {
    destroySession("ThisAdmin");
}
header("Location:car.php");
die();