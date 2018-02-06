<?php

require_once("config.php");
//Log the user out
if (isUserLoggedIn()) {
    destroySession("ThisUser");
}
header("Location:car.php");
die();