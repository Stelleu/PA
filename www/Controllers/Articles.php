<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Models\Articles as ModelArticle;
use App\Models\User as ModelUser;

class Articles extends \App\Core\Sql
{
    private array $errors = [];

    public function listArticles():void
    {
        $view = new View("Dash/articlesList");
        $articles = new ModelArticle();
        $addArticle = new AddArticle();
        $articles = $articles->getAll();
        $view->assign("title", "Articles");
        $view->assign("articles", $articles);
        $view->assign("addArticle", $addArticle->getConfig());
        if ($addArticle->isSubmit()){

        }

    }
    public function addUser($addArticle): bool|array
    {
        $this->errors = Verificator::form($addArticle->getConfig(), $_POST);
        $title = $_POST["Title"];
        if (empty($this->errors)) {
            $article = new ModelArticle();
            $verifyExistenceArticle = $article->search(['title' => $title]);
            if (!empty($verifyExistenceArticle)) {
                $this->errors[] = "L'article que vous essayez de créer existe déjà !";
            } else {
               $article->setTitle($_POST["Title"]);
               $article->setText($_POST["Text"]);
               $article->setAuthor($_SESSION["user"]["id"]);
               $article->setDateUpdated();
                return true;
            };
        };
        return $this->errors;
    }

}