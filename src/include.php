<?php
include "../config/config.php";
include "../model/dataLayer.class.php";

define("ROOT", dirname(dirname($_SERVER["SCRIPT_NAME"])));
define("SP", DIRECTORY_SEPARATOR);

session_start();

$model = new dataLayer();

// Fonction pour rediriger
function redirect($path)
{
    header("Location: " . ROOT . SP . $path);
    exit();
}

include "function.php";
