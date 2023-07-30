<?php

namespace App\Core;

class RouteVerificator extends Sql
{
    public static function checkConnexion():bool
    {
        return isset($_SESSION['user']['token']);
    }

    public static function checkSlug($slugName):bool
    {
        //$page = new Page();
       // return empty($this->search(['slug'=>$slugName]));
        return true;
    }

    public static function checkWhoIAm($roleNeeded):bool
    {
        $isRole = $_SESSION['user']['role'];
        return in_array($isRole, $roleNeeded) || empty($roleNeeded);
    }

}