<?php

namespace App\Controllers;
use App\Models\Article;
use App\Models\Version as ModelMemento;
class Memento extends \App\Core\Sql
{
    /**
     * @param int $versionId
     * @return void
     */
    public function undoContent(int $versionId) : void
    {
        $version = new ModelMemento();
        $version->search(["id"=>$versionId]);

        // Create a memento and store the current state
        $memento = $version->createMemento();

        // Modify the content
        $newContent = "Restored content goes here";
        $version->setContent($newContent);

        // Perform undo by restoring the original content from the memento
        $version->restoreMemento($memento);

        // Save the restored version
        $version->save(); // You need to implement the `save` method in Version class
    }


}