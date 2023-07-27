<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\LoginUser;
use App\Models\User as ModelUser;
use App\Core\Verificator;

class Security{

    public function login(): void
    {
        echo "Login";
        $form = new LoginUser();
        $view = new View("Auth/login","front");
        $view->assign('form',$form->getConfig());

        if ($form->isSubmit()){
            $errors = Verificator::form($form->getConfig(),$_POST);
            $email = $_POST["Email"];
            $pwd = $_POST["Password"];
            if (empty($errors)){
                $user = new ModelUser();
                $user = $user->search(['email'=>$pwd]);
                if (!empty($user) && $user->verifPwd($pwd)){
                    $user->generateToken();
                    $_SESSION["user"] = [
                        'id'        => $user->getId(),
                        'firstname' => $user->getFirstname(),
                        'lastname'  => $user->getLastname(),
                        'pwd'       => $user->getPwd(),
                        'email'     => $user->getEmail(),
                        'token'     => $user->getToken(),
                        'status'    => $user->getStatus(),
                        'role'      => $user->getRole(),
                    ];
                    //REDIRECTION DASHBOARD
                }
            }
        }
    }

    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());


        if($form->isSubmit()){
            $errors = Verificator::form($form->getConfig(), $_POST);
            if(empty($errors)){
                echo "Insertion en BDD";
            }else{
                $view->assign('errors', $errors);
            }
        }
        /*
        $user = new User();
        $user->setId(2);
        $user->setEmail("test@gmail.com");
        $user->save();
        */
    }

    public function logout(): void
    {
        echo "Logout";
    }

}