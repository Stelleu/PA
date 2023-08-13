<?php

namespace App\Controllers;
use App\Models\Article;
use App\Models\Version as ModelMemento;
use App\Models\VersionMemento;

class Memento extends \App\Core\Sql
{
    /**
     * @param int $versionId
     * @return void
     */
    public function undoContent() : void
    {
        $versionId = $_POST["id"];
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

    public function saveInMemento($requestData): string|bool
    {
        $content = $requestData['content'];
        $version = new ModelMemento();
        $version->setContent($content);
        $version->setUserId($_SESSION['user']['id']);
        $version->setCreatedAt();
        $version->setArticleId($requestData['id']);
//        $version->save();
        $latestVersion = (new \App\Models\Version)->getLatestVersion(["article_id"=>$requestData['id']],"created_at","DESC"); // Implémentez cette méthode dans la classe Version pour obtenir la dernière version
        if ($latestVersion) {
            $memento = new VersionMemento($latestVersion->getContent());
            $response = array(
                'success' => true,
                'restoredContent' => $memento->getContent()
            );
        } else {
            $response = array('success' => false);
        }
        header('Content-Type: application/json');
        return json_encode($response);
    }


}