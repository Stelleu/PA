<?php

namespace App\Models;

class Article extends \App\Core\Sql
{
   protected Int $id = 0;
   protected String $title;
   protected String $text;
   protected String $date_updated;
   protected String $author;
   protected Int $last_update;

    /**
     * @return Int
     */
    public function getLastUpdate(): int
    {
        return $this->last_update;
    }

    /**
     * @param Int $last_update
     */
    public function setLastUpdate(int $last_update): void
    {
        $this->last_update = $last_update;
    }
   protected Int $category;

    /**
     * @return Int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param Int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
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
        $this->title =ucfirst(trim($title)) ;
    }

    /**
     * @return String
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param String $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return String
     */
    public function getDateUpdated(): string
    {
        return $this->date_updated;
    }

    /**
     * @param String $date_updated
     */
    public function setDateUpdated(): void
    {
        $this->date_updated = date("Y-m-d H:i:s");
    }

    /**
     * @return Int
     */
    public function getAuthor(): Int
    {
        return $this->author;
    }

    /**
     * @param Int $author
     */
    public function setAuthor(String $author): void
    {
        $this->author = $author;
    }
    public function createMemento(): Memento
    {
        return new Memento($this->text, $this->id);
    }

    public function restoreMemento(Memento $memento): void
    {
        $this->text = $memento->getContent();
    }





}