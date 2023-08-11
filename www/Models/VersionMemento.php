<?php

namespace App\Models;

use App\Core\Sql;

class VersionMemento extends Sql
{
    protected string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}