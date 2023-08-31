<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Article;
use App\Models\Category;
use App\Models\PageViews;
use App\Models\User;

class Main{
    public function index(): void
    {
        $view = new View("Page/home","cleanPage");
        $articles = new Article();
        $articles = $articles->getAll();
        $categories = new Category();
        $categories = $categories->getAll();
        $users = new User();
        $view->assign("articles",$articles);
        $view->assign("users",$users);
        $view->assign("categories",$categories);
        $view->assign("title","Home");
    }

    public function dashboard(): void
    {
        $view = new View("Dash/index");
        $usersModel = new User();
        $users = $usersModel->getStats();
        $pageViews = PageViews::getInstance();
        $views = $pageViews->getStats();

        $view->assign("title", 'Home');
        $view->assign("users",$users);
        $view->assign("views",$views);
    }
}