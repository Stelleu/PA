<?php

namespace App\Forms;

class AddArticle extends Abstract\AForm
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
                "submit"=>"New article",
                "cancel"=>"Annuler",
                "id"=>"articleForm",
            ],
            "inputs" =>[
                "Titre"=>[
                    "type"=>"text",
                    "placeholder"=>"Titre",
                    "min"=>2,
                    "max"=>80,
                    "class"=>"form-control",
                    "error"=>"Votre title doit faire entre 2 et 80 caractères",
                    "disabled" => false

                ],
                "Auteur"=>[
                    "type"=>"text",
                    "placeholder"=>"",
                    "class"=>"form-control",
                    "error"=>"",
                    "disabled" => false

                ],
                "Categorie"=>[
                    "type"=>"select",
                    "class"=>"form-select mb-3",
                    "options"=>["Open this select menu"=>"","admin"=>"1", "editor"=>"2","moderator"=>"3","user"=>"4"],
                    "error"=>"Role incorrect",
                    "disabled" => false

                ]
            ],
            "textarea" => [
                "Article"=>[
                    "type"=>"textarea",
                    "placeholder"=>"",
                    "rows"=>10,
                    "min"=> 10,
                    "class"=>"form-control",
                    "error"=>"Votre Article doit faire avoir un minimum de 10 caractères",
                ],

            ]
        ];
    }

}