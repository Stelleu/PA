<?php

namespace App\Forms;

class AddArticle extends Abstract\AForm
{
    protected $method = "POST";
    private array $categorie;

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>$this->getMethod(),
                "action"=>"",
                "enctype"=>"",
                "class"=>"",
                "submit"=>"",
                "cancel"=>"",
                "id"=>"articleForm",
            ],
            "inputs" =>[
                "Titre"=>[
                    "type"=>"text",
                    "placeholder"=>"Titre",
                    "id"=>"title",
                    "min"=>2,
                    "max"=>80,
                    "class"=>"form-control",
                    "error"=>"Votre title doit faire entre 2 et 80 caractères",
                    "disabled" => false

                ],
                "Auteur"=>[
                    "type"=>"text",
                    "placeholder"=>"",
                    "id"=>"auteur",
                    "class"=>"form-control",
                    "error"=>"",
                    "disabled" => false

                ],
            ],
        ];
    }



}