<?php

namespace App\Controllers;
use App\Models\Article;
use App\Models\Memento as ModelMemento;
class Memento extends \App\Core\Sql
{
    public function undo($articleId): void
    {
        $article = new Article();
        $memento = $this->getLastMemento($articleId);
        $article->restoreMemento($memento);
    }

    private function getLastMemento($articleId): Memento
    {
        $memento = new ModelMemento();
        $mementos = $memento->getMementos($articleId);

        // Assuming the mementos are sorted in descending order by created_at
        return reset($mementos);
    }

}