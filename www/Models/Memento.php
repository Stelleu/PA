<?php

namespace App\Models;

use App\Core\Sql;
class Memento extends Sql
{
    protected Int $id = 0;
    protected String $created_at ;
    protected String $content;
    protected Int $user_id;
    protected Int $article_id;


    public function __construct( $content,$articleId)
    {
        $this->content = $content;
        $this->user_id = $_SESSION['user']['id'];
        $this->article_id = $articleId ;
        $this->created_at = date("Y-m-d H:i:s");
        parent::__construct();

    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return String
     */
    public function getDate(): string
    {
        return $this->date;
    }


    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }


    /**
     * @return Int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return Int
     */
    public function getArticleId(): int
    {
        return $this->article_id;
    }

    public function addMemento(): void
    {
        $this->save();
    }

    public function getMementos($articleId): array
    {
        return $this->selectOrder(['article_id' => $articleId], 'created_at', 'DESC');
    }

}