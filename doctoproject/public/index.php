<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../vendor/autoload.php';
require_once '../app/config/config.php';

use App\Controllers\FrontController;
use App\Controllers\ArticleController;
use App\Controllers\AdminController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$frontController = new FrontController();
$articleController = new ArticleController($pdo);
$adminController = new AdminController($pdo);

switch ($uri) {
    case '/':
    case '/index.php':
        
        $frontController->index();
        break;

    case '/apropos':
        $frontController->apropos();
        break;

    case '/admin_connexion':
        $frontController->admin_connexion();
        break;

    case '/dashboard':
        $adminController->dashboard();
        break;

    case '/articles':
        $lastposts = $articleController->getLastPost();
        $frontController->articles($lastposts);
        break;

    case '/formulaire':
        $frontController->formulaire();
        break;

    case '/services':
        $frontController->services();
        break;

    

    case '/connexion':
        $frontController->connexion();
        break;

    case '/deconnexion':
        $frontController->deconnexion();
        break;

    case '/inscription':
        $frontController->inscription();
        break;

    case '/deconnexion_medecin':
        $adminController->deconnexionMedecin();
        break;

    case '/admin/articles/create':
        $articleController->create();
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo '404 Not Found';
        break;
}
?>
