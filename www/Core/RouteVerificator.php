<?php

namespace App\Core;

use App\Models\Article;

class RouteVerificator extends Sql
{
    public static function checkConnexion():bool
    {
        return isset($_SESSION['user']['token']);
    }

    public static function checkSlugExists(): bool
    {
        $uriExploded = explode("/", $_SERVER["REQUEST_URI"]);
        $uri = trim($uriExploded[1], "/");
        $slug = new Article();
        return !empty($slug->search(['slug' => $uri])) ;
    }

    public static function checkWhoIAm($roleNeeded):bool
    {
        $isRole = $_SESSION['user']['role'];
        return in_array($isRole, $roleNeeded) || empty($roleNeeded);
    }

}