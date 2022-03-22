<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function pre($input)
{
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
}

//include all your model files here
require 'Model/Article.php';
//include all your controllers here
require 'Controller/HomepageController.php';
require 'Controller/ArticleController.php';

// Get the current page to load
// If nothing is specified, it will remain empty (home should be loaded)
$page = $_GET['page'] ?? null;

// Load the controller
// It will *control* the rest of the work to load the page
switch ($page) {
    case 'article-index':
        // This is shorthand for:
        $articleController = new ArticleController;
        $articleController->index();
        (new ArticleController())->index();
        break;
    case 'articles-show':
        // TODO: detail page
        $articleController = new ArticleController;
        $articleController->show();
        (new ArticleController())->show();
    case 'home':
    default:
        (new HomepageController())->index();
        break;
}