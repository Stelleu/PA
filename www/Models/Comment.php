<?php
namespace App\Models;
use App\Core\Sql;

class Comment extends Sql
{
    protected Int $id = 0;
    // protected Int $article_id;
    protected Int $page_id;
    protected Int $user_id;
    protected String $content;
    protected String $created_date;
    protected Int $report ;

    /**
     * @return Int
     */
    public function getReport(): int
    {
        return $this->report;
    }

    /**
     * @param Int $report
     */
    public function setReport(int $report): void
    {
        $this->report = $report +1 ;
    }

    public function setPageId(int $page_id): void
    {
        $this->page_id = $page_id;
    }

    public function getPageId(): int
    {
        return $this->page_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    // public function setArticleId(int $article_id): void
    // {
    //     $this->article_id = $article_id;
    // }

    // public function getArticleId(): int
    // {
    //     return $this->article_id;
    // }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setCreatedDate(): void
    {
        date_default_timezone_set('Europe/Paris');
        $this->created_date =  date("Y-m-d H:i:s");
    }

    public function getCreatedDate()
    {
        return $this->created_date;
    }

    public function showAllComment():array
    {
        return parent::getAll();
    }

    public function deleteComment():void
    {
        parent::delete();
    }
}