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
                "cancel"=>"Annuler"
            ],
            "inputs" =>[
                "Email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "error"=>"Le format de votre email est incorrect"
                ],
                "Password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "error"=>"Votre mot de passe est incorrect"
                ]
            ]
        ];


    }
}