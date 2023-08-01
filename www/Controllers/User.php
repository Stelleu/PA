<?php

namespace App\Controllers;

use App\Core\Sql;
use App\Core\Verificator;
use App\Core\View;
use App\Forms\AddUser;
use App\Models\User as ModelUser;

class User extends Sql
{
    private array $errors = [];

    public function listUser(): void
    {
        $view = new View("Dash/usersList");
        $users = new ModelUser();
        $users = $users->getAll();
        $view->assign("users",$users);
        $view->assign("title","Users");
    }

    public function addUser(): void
    {
//        $view = new View("Dash/");
        $user = new ModelUser();
        $addUser = new AddUser();
        $view = new View("Dash/usersList");
        $view->assign('form',$addUser->getConfig());
        if ($addUser->isSubmit())
        {
            $this->errors = Verificator::form($addUser->getConfig(),$_POST);
            $email = $_POST["Email"];
            if (empty($this->errors)){
                $user = $user->search(['email'=>$email]);
                if (!empty($user))
                {
                    json_encode("errors");
                }else{
                    $user->setEmail($email);
                    $user->setFirstname($_POST["Firstname"]);
                    $user->setLastname($_POST["Lastname"]);
                    $user->setRole($_POST["Role"]);
                    $user->setPassword($_POST["pwd"]);
                    $user->setDateInserted();
                    $user->save();
                }
            }
        }
    }

    public function deleteUser()
    {

    }


}