<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\User as ModelUser;

class Article extends \App\Core\Sql
{
    private array $errors = [];

    public function listArticle():void
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
               $article->setText($_POST["Article"]);
               $article->setAuthor($_POST["Auteur"]);
               $article->setLastUpdate($_SESSION["user"]["id"]);
               $article->setCategorie($_POST['Categorie']);
               $article->setDateUpdated();
                return true;
            };
        };
        return $this->errors;
    }

    public function newArticle():void
    {
        $view = new View("Dash/article");
        $articles = new ModelArticle();
        $addArticle = new AddArticle();
        $view->assign("title", "New Article");
        $view->assign("articles", $articles);
        $view->assign("addArticle", $addArticle->getConfig());
    }

}