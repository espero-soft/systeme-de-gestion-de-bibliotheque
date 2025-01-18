<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/main.css">
    <!-- <style>
        h2{
            color: red ;
        }
    </style> -->
</head>

<body>
    <div id="app" class="relative">
        <div class="overlay fixed"></div>
        <div class="container relative">
            <div class="container-row">
                <header class="flex aic jcsb">
                    <div class="header-right">
                        <h2>Systeme de gestion de bibliotheque</h2>
                    </div>
                    <div class="header-left flex gap-15">
                        <a href=""><?php
                                    if (isset($_SESSION["connexion"]["user_status"])) {
                                        $firstname = $_SESSION["connexion"]["firstname"];
                                        $lastname = $_SESSION["connexion"]["lastname"];
                                        $result = $_SESSION["connexion"]["user_status"];
                                        $result .= ":" . $firstname . " " . $lastname;
                                        echo $result;
                                    }
                                    ?></a>
                        <a href="deconnexion">Deconnexion</a>
                    </div>
                </header>
            </div>
            <div class="container-row flex gap-15">
                <div class="column nav">
                    <nav class="">
                        <ul class="unlisted">
                            <li class="nav-item flex jcc aic">
                                <a href=<?php echo ROOT . SP . "Accueil"; ?>>Accueil</a>
                            </li>
                            <li class="nav-item flex jcc aic">
                                <a href=<?php echo ROOT . SP . "Livre"; ?>>Livres</a>
                            </li>
                            <?php if (isset($_SESSION["connexion"]) && $_SESSION["connexion"]["user_status"] == "admin"): ?>
                                <li class="nav-item flex jcc aic">
                                    <a href=<?php echo ROOT . SP . "Ajouter"; ?>>Ajouter un livre</a>
                                </li>
                            <?php endif ?>
                            <li class="nav-item flex jcc aic">
                                <a href=<?php echo ROOT . SP . "Emprunter"; ?>>Emprunter un livre</a>
                            </li>
                            <li class="nav-item flex jcc aic">
                                <a href=<?php echo ROOT . SP . "Retourner"; ?>>Retourner un livre</a>
                            </li>
                            <li class="nav-item flex jcc aic">
                                <a href=<?php echo ROOT . SP . "Rechercher"; ?>>Rechercher un livre</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="column content">
                    <div class="content-title flex jcc">
                        <h2>Bibliothèque Centrale de Dakar </h2>
                    </div>
                    <div class="content-description">
                        <?php

                        echo $content;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>