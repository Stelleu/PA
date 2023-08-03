<?php
namespace App\Forms;

use App\Forms\Abstract\AForm;

class AddUser extends AForm {

    protected $method = "POST";

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "class"=>"",
                "submit"=>"Add",
                "cancel"=>"Annuler",
                "id"=>"adminForm",
            ],
            "inputs" =>[
                "Firstname"=>[
                        "type"=>"text",
                        "placeholder"=>"Votre prénom",
                        "min"=>2,
                        "max"=>60,
                        "class"=>"form-control",
                        "error"=>"Votre prénom doit faire entre 2 et 60 caractères"
                    ],
                "Lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "min"=>2,
                    "max"=>120,
                    "class"=>"form-control",
                    "error"=>"Votre nom doit faire entre 2 et 120 caractères"
                ],
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
                ],
                "PasswordConfirmation"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "confirm"=>"Password",
                    "class"=>"form-control",
                    "error"=>"Mot de passe de confirmation incorrect"
                ],
                "Role"=>[
                    "type"=>"select",
                    "class"=>"form-select mb-3",
                    "options"=>["Open this select menu"=>"","admin"=>"0", "editor"=>"1","moderator"=>"2","user"=>"3"],
                    "error"=>"Role incorrect"
                ]
            ]
        ];
    }

}