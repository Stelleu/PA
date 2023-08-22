<?php

namespace App\Controllers;

use App\Core\View;
use App\Forms\AddArticle;
use App\Models\Article as ModelArticle;
use App\Models\Category;
use App\Models\Category as ModelCategory;
use App\Models\User as ModelUser;
use App\Models\Version;
use App\Models\VersionMemento;

class Categories extends \App\Core\Sql
{
    public function listCategorie():void
    {
        $categories = new ModelCategory();
        $view = new View("Dash/categoryList");
        $categories = $categories->getAll();
        $view->assign("title", "Category");
        $view->assign("categories", $categories);
        if (!empty($_POST["add"])){
            var_dump($_POST);
            $category = new ModelCategory();
            $category->setTitle($_POST['title']);
            $category->save();
            header("refresh: 1");
        }if (!empty($_POST["edit"])){
            $this->editCategory();
        }if (!empty($_POST["delete"])){
            $this->deleteCategory();
        }
    }

    public function deleteCategory(): void
    {
        $categoryToDelete = new  ModelCategory();
        $categoryToDelete->setId($_POST["id"]);
        echo $categoryToDelete->getId();
        $categoryToDelete->delete();
    }

    public function editCategory(): void
    {
        $category = new ModelCategory();
        $category = $category->search(["id" => $_POST["id"]]);
        if (isset($_POST['changes'])){
            $category->setId($_POST["id"]);
            ($category->getTitle() != $_POST["id"])? $category->setTitle($_POST["id"]):$category->setTitle($category->getTitle());
            $category->save();
        }else {
            if ($category) {
                $category = [
                    "id" => $category->getId(),
                    "title" => $category->getTitle()
                ];
                echo json_encode(["success" => true, "content" => $category]);
            }else{
                echo json_encode(["success" => false, "message" => "Invalid request"]);
            }
        }
    }
}