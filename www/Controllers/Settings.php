<?php

namespace App\Controllers;
use \App\Core\Sql;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageViews;
use App\Models\Setting;
use App\Models\Version;

class Settings extends Sql
{
    public function listMenu(): void
    {
        $view = new View("Dash/gestion");
        $categories = new Category();
        $categories = $categories->getAll();
        $pages = new Page();
        $pages = $pages->getAll();
        $settings = new Setting();
        $settings = $settings->getAll();
        $view->assign("title", "Menu");
        $view->assign("categories", $categories);
        $view->assign("pages", $pages);
        $view->assign("settings", $settings);

    }

    public function setMenu(): void
    {
        $page = new Page();
        $category = new Category();
        if (isset($_POST["addMenu"])) {
            $page->setMenu(1);
            $page->setId($_POST["page"]);
            $page->save();
        } elseif (isset($_POST["delMenu"])) {
            $page->setId($_POST["page"]);
            $page->setMenu(0);
            $page->save();
        }elseif (isset($_POST["addSubMenu"])) {
            $category->setMenu(1);
            $category->setId($_POST["page"]);
            $category->save();
        }elseif (isset($_POST["delSubMenu"])) {
            $category->setId($_POST["page"]);
            $category->setMenu(0);
            $category->save();
        }
    }

    public function setFront(): void
    {
        var_dump($_POST);
        $settings = new Setting();
        $settings->setId(1);
        if (!empty($_POST["newFront"])) {
            $settings->setPolices($_POST["font"]);
            $settings->setBtnColor($_POST['btnsColor']);
            $settings->setPColor($_POST['pColor']);
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
        $page = new Page();
        $slug= trim(strtolower($slug));

        $article = $article->search(["slug" => $slug]);
        $page = $page->search(["slug" => $slug]);

        $setting = new \App\Models\Setting();
        $settingData = $setting->getAll();

        $menu = new ModelArticle();
        $menuData = $menu->multipleSearch(["menu" => "false", "status" => "false"]);

        $categorie = new Category();
        $categorieData = $categorie->getAll();

        $articles = new ModelArticle();
        $articlesData = $articles->getAll();

        $version = new Version();
        $versionData = [];

        $comments = new \App\Models\Comment();
        $commentsData = $comments->getAll();

        $view = new View("Page/slug", "cleanPage");

        if (!empty($article)) {
            if (empty($_SESSION["user"])) {
                $pageViews = PageViews::getInstance();
                $pageViews->setSlug($slug);
                $pageViews->setDateInserted();
                $pageViews->save();
            }
            $view->assign("title", $article->getTitle());
            $view->assign("article", $article);
            $version = $version->selectOrder(["article_id" => $article->getId()], "created_at", "DESC");
            $view->assign("version", $version);

        } elseif (!empty($page)) {
            $view->assign("title", $page->getTitle());
            $view->assign("page",$page);
        }
        $view->assign("menu", $menuData);
        $view->assign("categories", $categorieData);
        $view->assign("comments", $commentsData);
        $view->assign("front", $settingData);
        $view->assign("articles", $articlesData);

    }


    public function getSitemap():void
    {
        $slug = new Page();
        $slug = $slug->getAll();
        $view = new View("Page/sitemap","sitemap");
        $view->assign('slug',$slug);
        $view->assign('title','Sitemap');
    }
}