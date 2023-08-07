<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
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
               $article->setCategory($_POST['Categorie']);
               $article->setDateUpdated();
                return true;
            };
        };
        return $this->errors;
    }

    public function newArticle():void
    {
            $options = [];
            $view = new View("Dash/article");
            $articles = new ModelArticle();
            $addArticle = new AddArticle();
            $categories = new Category();
            $categories = $categories->getAll();
             $view->assign("category",$categories);
            $view->assign("title", "New Article");
            $view->assign("articles", $articles);
            $view->assign("addArticle", $addArticle->getConfig());

    }
    public function newArticles($requestData): string|bool
    {
        $article = new ModelArticle();
        $article->setDateUpdated();
        if (empty($article->search(["title"=> $requestData["title"]]))){
            $article->setTitle($requestData["title"]);
            $article->setAuthor($_SESSION["user"]["id"]);
            $article->setText(json_encode($requestData["article"]));
            $article->setCategory($requestData["category"]);
            $article->setLastUpdate($_SESSION["user"]["id"]);
            $article->save();
            $response = array("success" => true, "message" => "Article saved");
            header('Content-Type: application/json');
            return json_encode($response);
        }else{
            $response = array("success" => false, "message" => "Title already exist");
            header('Content-Type: application/json');
            return json_encode($response);
        }
    }


    public function listCategorie():void
    {
        $categories = new Category();
        $view = new View("Dash/categoryList");
        $categories = $categories->getAll();
        $view->assign("title", "New categories");
        $view->assign("categories", $categories);
        if (!empty($_POST)){
            $category = new Category();
            $category->setTitle($_POST['title']);
            $category->save();
            header("refresh: 1");
        }
    }
}