<?php

declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class ArticleController
{
    private DatabaseManager $database;


    public function __construct()
    {
        require 'config.php';
        require_once 'DatabaseManager.php';
        $this->database = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname'],);
        $this->database->connect();
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/article/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        // prepare the database connection
        // Note: you might want to use a re-usable databaseManager class - the choice is yours       
        $query = "SELECT * FROM articles";
        $result = $this->database->connection->query($query);
        // fetch all articles as $rawArticles (as a simple array)
        $rawArticles = $result->fetchAll(PDO::FETCH_ASSOC);
        // pre($rawArticles);

        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id']);
        }
        // pre($articles);

        return $articles;
    }

    public function show()
    {
        // TODO: this can be used for a detail page
        $query = "SELECT * FROM articles WHERE id = {$_GET['id']}";
        $result = $this->database->connection->query($query);
        $rawArticle = $result->fetch(PDO::FETCH_ASSOC);

        $article= new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id']);
        require 'View/article/show.php';
    }
}