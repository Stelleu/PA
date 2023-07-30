<?php
namespace App\Controllers;
use App\Core\View;

class Main{
    public function index(){

        $pseudo = "Prof";
        $view = new View("Main/index", "front");
        $view->assign("pseudo", $pseudo);
    }

    public function contact(){
        $view = new View("Main/contact", "front");
    }

    public function dashboard(): void
    {
        $view = new View("Dash/index");
        $view->assign("title", 'Home');

    }
}