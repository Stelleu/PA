<?php

namespace App\Models;

use Cassandra\Float_;

class Articles extends \App\Core\Sql
{
   protected Int $id;
   protected String $title;
   protected String $text;
   protected String $date_updated;
   protected String $author;

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
        $this->title = $title;
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
     * @return String
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param String $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }





}