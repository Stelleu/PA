<?php

namespace App\Forms;

class LoginUser extends Abstract\AForm
{
    protected $method = "POST";
    public function getConfig(): array
    {

        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "submit"=>"Se connecter",
                "cancel"=>"",
                "class"=>"",
                "id"=>"",
            ],
            "inputs" =>[
                "Email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control",
                    "error"=>"Le format de votre email est incorrect"
                ],
                "Password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control",
                    "error"=>"Votre mot de passe est incorrect"
                ]
            ]
        ];


    }
}