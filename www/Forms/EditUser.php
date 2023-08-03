<?php

namespace App\Forms;

class EditUser extends Abstract\AForm
{
    protected $method = "POST";
    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "class"=>"",
                "submit"=>"Save changes",
                "cancel"=>"Annuler",
                "id"=>"editForm",
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"text",
                    "class"=>"form-control",
                    "placeholder"=>"",
                    "disabled"=>true,

                ],
                "Lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "min"=>2,
                    "max"=>120,
                    "class"=>"form-control",
                    "error"=>"Votre nom doit faire entre 2 et 120 caractères",
                    "disabled" => false
                ],
                "Email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "class"=>"form-control",
                    "error"=>"Le format de votre email est incorrect",
                    "disabled" => false
                ],
                "Password"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "class"=>"form-control",
                    "error"=>"Votre mot de passe est incorrect",
                    "disabled" => false
                ],
                "Role"=>[
                    "type"=>"select",
                    "class"=>"form-select mb-3",
                    "options"=>["Open this select menu"=>"","admin"=>"0", "editor"=>"1","moderator"=>"2","user"=>"3"],
                    "error"=>"Veuillez selectionner un role",
                    "disabled" => false
                ]
            ]
        ];
    }
}