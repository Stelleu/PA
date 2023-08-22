<?php

namespace App\Controllers;

use App\Forms\AddComment;
use App\Models\Comment as ModelComment;
use App\Core\Verificator;
use App\Core\View;
use App\Models\Pages;

// use ChallengeS2\Models\Comment;

class Comment
{
    public function showComments(): void
    {
        $form = new AddComment();
        $commentsModel = new ModelComment();
        $view = new View("Dash/comments", "back");
        $comments = $commentsModel->showAllComment();
        $view->assign("comments", $comments);
        $view->assign('form', $form->getConfig());

        if ($form->isSubmit()) {
            $comment = new ModelComment;
            $errors = Verificator::form($form->getConfig(), $_POST);

            // Additional validation, e.g., if the comment content is valid, etc.

            if (empty($errors)) {
                if ($this->addComment($comment)) {
                    // Handle successful comment addition
                } else {
                    // Handle failure to add the comment
                }
            } else {
                $errors[] = "OUPS! Something went wrong!";
                $view->assign('errors', $errors);
            }
        }
    }

    public function updateComments(): void
    {
        $commentsModel = new ModelComment();
        $view = new View("Dash/comments", "back");
        $comments = $commentsModel->updateComment();
        $view->assign("comments", $comments);
    }

    public function addComment()
    {
        if (isset($_SESSION["page"], $_POST["action"], $_POST["statut"]) && $_POST["action"] === "addCommentOption") {
            $addOption = new Pages();
            $addOption->setComment($_POST["statut"]);
            $addOption->setId($_SESSION["page"]);
            $addOption->setUpdatedAt();
            $addOption->save();
        }
    }



    public function deleteComments(): void
    {
        $comment = new ModelComment();
        $comment->setId($_POST["comment_id"]); // Assuming you are passing the comment ID in $_POST.
        $comment->deleteComment();
        // Redirect to appropriate page after deleting the comment.
        header('Location: /admin/comments');
    }
}

