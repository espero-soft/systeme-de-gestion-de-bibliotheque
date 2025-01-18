<?php
session_start();
include "include.php";

// Définir les routes disponibles
$routes = [
    '' => 'accueil',
    'accueil' => 'accueil',
    'livre' => 'livre',
    'ajouter' => 'ajouter',
    'emprunter' => 'emprunter',
    'retourner' => 'retourner',
    'rechercher' => 'rechercher',
    'handlebooks' => 'handleBooks',
    'displaysearchbooks' => 'displaySearchBooks',
    'dueloan' => 'dueLoan',
    'pageregister' => 'pageRegister',
    'pageconnexion' => 'pageConnexion',
    'register' => 'register',
    'authentifier' => 'authentifier',
    'deconnexion' => 'deconnexion'
];

// Routes accessibles sans connexion
$publicRoutes = ['pageregister', 'pageconnexion', 'register', 'authentifier'];

// Récupérer la route demandée
$request = strtolower(trim($_SERVER['REQUEST_URI'], '/'));


// Extraire la partie de la route après le dernier '/'
$request = basename($request);

// Vérifier si la route existe
if (array_key_exists($request, $routes)) {
    $function = $routes[$request];

    // Vérifier l'accès
    if (isset($_SESSION['connexion']) || in_array($request, $publicRoutes)) {
        $title = ucfirst($request);
        $content = $function();
        include "views/template/default.php";
    } else {
        // Rediriger vers la page de connexion
        include "views/reception/login.php";
    }
} else {
    // Gestion des erreurs 404
    http_response_code(404);
    echo "Page introuvable !";
}
