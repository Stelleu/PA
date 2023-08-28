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
        $settings = new Setting();
        $settings = $settings->getAll();
        $view->assign("title", "Menu");
        $view->assign("articles", $articles);
        $view->assign("settings", $settings);

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
        if (!empty($_POST["newFront"])) {
            $settings->setPolices($_POST["fontSelector"]);
            $settings->setBtnColor($_POST['btnsColor']);
            $settings->setPColor($_POST['pColorPicker']);
            $settings->setPSize($_POST['fontSize']);
            $settings->setH1Color($_POST['hColor']);
            $settings->save();
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
        $comments = new \App\Models\Comment();
        $comments=$comments->getAll();
        $view = new View("Page/slug", "cleanPage");
        $view->assign("title",$article->getTitle());
        $view->assign("menu",$menu);
        $view->assign("categories",$categorie);
        $view->assign("comments",$comments);
        $view->assign("front",$setting);
        $view->assign("articles",$articles);
        $view->assign("article",$article);
        $view->assign("version",$version);
    }


    public function getSitemap():void
    {
        $slug = new Pages();
        $slug = $slug->getAll();
        $view = new View("Page/sitemap","cleanPage");
        $view->assign('slug',$slug);
        $view->assign('title','Sitemap');
    }
}