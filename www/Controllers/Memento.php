<?php

namespace App\Controllers;
use App\Models\Article;
use App\Models\Version as ModelMemento;
use App\Models\VersionMemento;

class Memento extends \App\Core\Sql
{
    /**
     * @param int $versionId
     * @return string|false
     */
    public function undoContent($requestData) : string|bool
    {
        $response = [];
        try {
            $version = new ModelMemento();
           $version =  $version->search(["id" => $requestData['id']]);
            if ($version) {
                $memento = new VersionMemento($version->getContent());
                $restoredContent = $memento->getContent();

                $response['success'] = true;
                $response['restoredContent'] = $restoredContent;

            } else {
                $response['success'] = false;
                $response['error'] = "Version not found";
            }
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['error'] = $e->getMessage();
        }

        header('Content-Type: application/json');
        return json_encode($response);
    }

    public function getVersionList(): void
    {
        $response = [];

        try {
            $versionModel = new ModelMemento();

            $versions = $versionModel->getAll();
            $formattedVersions = [];
            foreach ($versions as $version) {
                $formattedVersions[] = [
                    'id' => $version->getId(),
                    'content' => $version->getContent(),
                    'created_at' => date('d / m', strtotime($version->getCreatedAt()))
                ];
            }

            $response['success'] = true;
            $response['versions'] = $formattedVersions;
        } catch (\Exception $e) {
            $response['success'] = false;
            $response['error'] = $e->getMessage();
        }

        header('Content-Type: application/json');
        echo json_encode($response);
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