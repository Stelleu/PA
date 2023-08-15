<?php

namespace App\Controllers;
use \App\Core\Sql;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Version;

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
    public function getSlug($slug): void
    {
        $article = new ModelArticle();
        $article = $article->search(["slug" => $slug]);
        $setting = new \App\Models\Setting();
        $setting = $setting->getAll();
        $menu = new ModelArticle();
        $menu = $menu->multipleSearch(["menu"=>"false","status"=>"false"]);
        $categorie = new Category();
        $categorie = $categorie->getAll();
        $articles = new ModelArticle();
        $articles = $articles->getAll();
        $version = new Version();
        $version = $version->selectOrder(["article_id"=>$article->getId()],"created_at","DESC");
        $view = new View("Page/slug", "cleanPage");
        $view->assign("title",$article->getTitle());
        $view->assign("menu",$menu);
        $view->assign("categories",$categorie);
        $view->assign("front",$setting);
        $view->assign("articles",$articles);
        $view->assign("version",$version);
    }
}