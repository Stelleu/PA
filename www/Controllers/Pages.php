<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\View;
use App\Models\Category;
use App\Models\Page as Build;
class Pages extends Sql
{
    public function index():void
    {
        $view = new View("Dash/pageBuilder","builder");
        $categories = new Category();
        $categories = $categories->getAll();
        $view->assign("title","Page builder");
        $view->assign("categories",$categories);
    }
    public function pages($requestData): string|bool
    {
        var_dump($requestData);
        $pageBuild = new Build();
        if (!empty($pageBuild->search(["title"=> $requestData["title"]]))){

            $pageBuild->setContent($requestData["content"][0]);
            $pageBuild->setUpdatedAt();
            $pageBuild->setSlug($requestData["title"]);
            $pageBuild->setCategory($requestData["id"]);
            $pageBuild->setDescription($requestData["description"]);
            $pageBuild->save();
            $response = array("success" => true, "message" => "Page saved");
        }else{

            $response = array('error' => 'Pages Already exist ! ');
            http_response_code(400);
        }
            return json_encode($response);
    }


}