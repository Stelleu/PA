<?php

namespace App\Models;

use App\Core\Sql;
class Version extends Sql
{
    protected Int $id = 0;
    protected String $created_at ;
    protected String $content;
    protected Int $user_id;
    protected Int $article_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(): void
    {
        $this->created_at = date("Y-m-d H:i:s");
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function setArticleId(int $article_id): void
    {
        $this->article_id = $article_id;
    }
    public function createMemento(): VersionMemento
    {
        return new VersionMemento($this->content);
    }

    // Restore the state from a memento
    public function restoreMemento(VersionMemento $memento): void
    {
        $this->content = $memento->getContent();
    }


}