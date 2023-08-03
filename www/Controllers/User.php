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
        $addUser = new AddUser();
        $users = $users->getAll();
        $view->assign("title","Users");
        $view->assign("users",$users);
        $view->assign("addUser",$addUser->getConfig());
        if ($addUser->isSubmit())
        {
            $verifUser = $this->addUser($addUser);
            if (!empty($verifUser)){
                $view->assign("errors",$this->addUser($addUser));
            };
        }
    }

    public function addUser($addUser): bool | array
    {
            $this->errors = Verificator::form($addUser->getConfig(),$_POST);
            $email = $_POST["Email"];
            var_dump($_POST);
            if (empty($this->errors)){
                $user = new ModelUser();
                $verifyExistenceUser = $user->search(['email'=>$email]);
                if (!empty($verifyExistenceUser))
                {
                    $this->errors[] = "L'utilisateur que vous essayez de créer existe déjà !";
                }else{
                    $user->setEmail($email);
                    $user->setFirstname($_POST["Firstname"]);
                    $user->setLastname($_POST["Lastname"]);
                    $user->setRole($_POST["Role"]);
                    $user->setPassword($_POST["Password"]);
                    $user->setDateInserted();
                    $user->save();
                    //send mail
                    //(new Security)->sendMail();
                    var_dump($user);
                    return true;
                };
            };
        return $this->errors ;
    }

    public function deleteUser()
    {

    }


}