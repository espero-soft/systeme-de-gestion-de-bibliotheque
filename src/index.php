<?php
include "include.php";
// if (!isset($_SESSION["request"])) {
//     $_SESSION["request"]=explode("/",trim($_SERVER["PATH_INFO"],"/")) ;
// }

$root = array(
    "accueil",
    "livre",
    "ajouter",
    "emprunter",
    "retourner",
    "rechercher",
    "handlebooks",
    "displaysearchbooks",
    "dueloan",
    "pageregister",
    "pageconnexion",
    "register",
    "authentifier",
    "deconnexion"
);
$root_connexion = array("pageregister", "pageconnexion", "register", "authentifier");

$arr = explode("/", trim($_SERVER["PATH_INFO"], "/"));
$request = strtolower($arr[0]);
// print_r($request) ; exit() ;
// print_r($_SERVER) ; exit() ;
if (in_array($request, $root)) {
    $function = $request;
    if (isset($_SESSION["connexion"])) {
        // L'utilisateur est connecté
        $title = ucwords($request);
        $content = $function();
        include "../views/template/default.php";
    } else {
        // L'utilisateur n'est pas  connecté, on lui renvoie sur la page connexion
        if (in_array($function, $root_connexion)) {
            $function();
        } else {
            include "../views/reception/login.php";
        }
    }
} else {
    //Error 
    echo "Page introuvable !";
}


// print_r($_POST) ; exit() ;
