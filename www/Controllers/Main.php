<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Article;
use App\Models\Category;

class Main{
    public function index(): void
    {
        $view = new View("Page/home","cleanPage");
        $articles = new Article();
        $articles = $articles->getAll();
        $categories = new Category();
        $categories = $categories->getAll();
        $users = new \App\Models\User();
        $users = $users->subscribeUser();
        $view->assign("articles",$articles);
        $view->assign("users",$users);
        $view->assign("categories",$categories);
        $view->assign("title","Home");
    }

    public function contact(){
        $view = new View("Main/contact", "front");
    }

    public function dashboard(): void
    {
        $view = new View("Dash/index");
        $view->assign("title", 'Home');

    }

    public function getAllArticle():void
    {

    }
}