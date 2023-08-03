<?php
namespace App\Controllers;
use App\Core\View;
use App\Forms\AddUser;
use App\Forms\LoginUser;
use App\Models\Mail;
use App\Models\User as ModelUser;
use App\Core\Verificator;

class Security{
    protected array $errors = [];

    public function login(): void
    {

        $form = new LoginUser();
        $view = new View("Auth/login","front");
        $view->assign('form',$form->getConfig());

        if ($form->isSubmit()){
            $this->errors = Verificator::form($form->getConfig(),$_POST);
            $email = $_POST["Email"];
            $pwd = $_POST["Password"];
            if (empty($this->errors)){
                $user = new ModelUser();
                $user = $user->search(['email'=>$email]);
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
                }else{
                    $this->errors[] = "Identifiants incorrects";
                }
            }else{
                $this->errors[] = "Identifiants incorrect";
            }
        }
        $view->assign('title',"Login");
        $view->assign('errors',$this->errors);
    }

    public function register(): void
    {
        $form = new AddUser();
        $view = new View("Auth/register", "front");
        $view->assign('form', $form->getConfig());
        if($form->isSubmit()){
            $this->errors = Verificator::form($form->getConfig(), $_POST);
            if(empty($this->errors)){
                echo "Insertion en BDD";
            }else{
                $view->assign('errors', $this->errors);
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
        session_destroy();
        //REDIRECTION LOGIN

    }

    public function sendMail(): void
    {
        $mail = new Mail();
        $code = new ModelUser();
        $confMail = new Mail();
        $confMail->setName($_POST["firstname"]);
        $confMail->setSubject("Mail de confirmation");
        $confMail->setAddress($_POST["email"]);
        $confMail->setMessage('
                                            <div class="card-body">
                                            <h5 class="card-title"> Adebc vous souhaite la bienvenue ! </h5>
                                            <p class="card-text">Une fois votre compte validé vous pourrez commenter autant que vous le souhaitez !.</p>
                                            <p class="card-text">Oublie pas le respect est OBLIGATOIRE chez nous ;)  .</p>
                                                <button><a class="btn btn-primary" href="http://193.70.2.69/admin/confirmation?key='.$code->generateCode().'"> Confirmer votre mail. </a></button>
                                           </div>');
        $mail = $confMail->mail($confMail->initMail());
    }

}