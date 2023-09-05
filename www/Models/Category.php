<?php

namespace App\Models;

use App\Core\Sql;

class Category extends Sql
{
    protected int $id = 0;
    protected int $menu = 0;
    protected String $title;

    public function isMenu(): int
    {
        return $this->menu;
    }

    public function setMenu(int $menu): void
    {
        $this->menu = $menu;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = strtolower(trim($title));
    }


}