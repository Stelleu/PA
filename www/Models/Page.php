<?php

namespace App\Models;

use App\Core\Sql;

class Page extends Sql
{
    protected Int $id = 0;
    protected String $title;
    protected String $slug;
    protected String $description;
    protected Int $status;
    protected int $menu;

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setCategory(int $category): void
    {
        $this->category = $category;
    }
    protected String $content;
    protected String $updated_at;

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(): void
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = strtolower(trim(str_replace(' ', '-', preg_replace('/[[:punct:]]/', '', $this->getTitle()))));
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getMenu(): int
    {
        return $this->menu;
    }

    public function setMenu(int $menu): void
    {
        $this->menu = $menu;
    }




}