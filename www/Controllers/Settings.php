<?php

namespace App\Controllers;
use \App\Core\Sql;
use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;

class Settings extends Sql
{
    public function listMenu():void
    {
        $view = new View("Dash/gestion");
        $articles = new ModelArticle();
        $articles = $articles->getAll();
        var_dump($articles);

        $view->assign("title", "Menu");
        $view->assign("articles", $articles);

    }

    public function setMenu():void
    {
        $articles = new ModelArticle();
        if (isset($_POST["addMenu"])){
            $articles->setMenu(1);
            $articles->setId($_POST["page"]);
            $articles->save();
        }elseif(isset($_POST["delMenu"])){
            $articles->setId($_POST["page"]);
            $articles->setMenu(0);
            $articles->save();
        }

    }

}