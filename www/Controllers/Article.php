<?php

namespace App\Controllers;

use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
use App\Models\User as ModelUser;
use App\Models\Version;
use App\Models\VersionMemento;

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
    public function deleteArticle(): void
    {
        $userToDelete = new  ModelArticle();
        var_dump($_POST);
        $userToDelete->setId($_POST["id"]);
        echo $userToDelete->getId();
        $userToDelete->delete();
    }

    public function newArticle():void
    {
        //AFFICHAQUE DE LA CREATION D'ARTICLE
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
        // AJOUT DES ARTICLES
        $article = new ModelArticle();
        $firstVersion = new Version();
        $articleAlreadyExist =$article->search(["title"=> trim($requestData["title"])]);
        //SI NON EXISTANT  ALORS ON AJOUT SINON ERREUR
        if (empty($articleAlreadyExist)){
            $article->setTitle($requestData["title"]);
            $article->setAuthor($_SESSION["user"]["id"]);
            $article->setCategory($requestData["category"]);
            $article->setCreatedAt();
            $article->setComment($requestData["comment"]);
            $article->setSlug();
            $article->save();
            $article = $article->search(["title"=> $article->getTitle()]);
            $firstVersion->setArticleId($article->getId());
            $firstVersion->setUserId($_SESSION["user"]["id"]);
            $firstVersion->setContent(json_encode($requestData["article"]));
            $firstVersion->setCreatedAt();
            $firstVersion->save();
            $response = array("success" => true, "message" => "Article saved");
        }else{
            $response = array("success" => false, "message" => "Article exist");
        }
        header('Content-Type: application/json');
        return json_encode($response);
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

    public function editArticle():void
    {
        $view = new View("Dash/editArticle");
        $article = new ModelArticle();
        $addArticle = new AddArticle();
        $version = new Version();
        $articleId = $_GET["id"];
        $latestVersion = $version->selectOrder(["article_id"=>$articleId],"created_at","DESC");
        if ($latestVersion) {
            $memento = new VersionMemento($latestVersion->getContent());
            $version->setContent($memento->getContent());
        }
        $article = $article->search(["id" => $articleId]);
        $categories = new Category();
        $categories = $categories->getAll();
        $view->assign("category", $categories);
        $view->assign("title", "Edit Article");
        $view->assign("article", $article);
        $view->assign("version", $version);
        $view->assign("addArticle", $addArticle->getConfig());
    }
    public function statusArticle():void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
            $articleId = $_POST["id"];

            $article = new ModelArticle();
            $article = $article->search(["id" => $articleId]);
            if ($article) {
                $currentStatus = $article->getStatus();
                $newStatus = !$currentStatus;
                $article->setStatus($newStatus);
                $article->save();

                $response = ["success" => true, "message" => $newStatus ? "Article published" : "Article unpublished"];
            } else {
                $response = ["success" => false, "message" => "Article not found"];
            }
        } else {
            $response = ["success" => false, "message" => "Invalid request"];
        }

        header("Content-Type: application/json");
        echo json_encode($response);

    }


}