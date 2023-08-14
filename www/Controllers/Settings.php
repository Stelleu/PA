<?php

namespace App\Controllers;
use \App\Core\Sql;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Setting;

class Settings extends Sql
{
    public function listMenu(): void
    {
        $view = new View("Dash/gestion");
        $articles = new ModelArticle();
        $articles = $articles->getAll();
        $view->assign("title", "Menu");
        $view->assign("articles", $articles);

    }

    public function setMenu(): void
    {
        $articles = new ModelArticle();
        if (isset($_POST["addMenu"])) {
            $articles->setMenu(1);
            $articles->setId($_POST["page"]);
            $articles->save();
        } elseif (isset($_POST["delMenu"])) {
            $articles->setId($_POST["page"]);
            $articles->setMenu(0);
            $articles->save();
        }
    }

    public function setFront(): void
    {
        $settings = new Setting();
        $settings->setId(1);
        if (!empty($_POST["action"] === "front")) {
            $settings->setPolices($_POST["font"]);
            $settings->setBtnColor($_POST['btnColor']);
            $settings->setPColor($_POST['color']);
            $settings->setPSize($_POST['fontSize']);
        } elseif ($_POST["action"] === "title") {
            $settings->setWebsiteName($_POST["title"]);
        }
    }

    public function getSlug($slug):void
    {
        $article = new \App\Models\Article();
        $article = $article->search(["slug" => $slug]);
        var_dump($article);
    }
}