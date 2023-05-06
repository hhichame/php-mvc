<?php

namespace Application\Controllers\AddComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;

class AddComment
{
    public function AddComment(string $post, array $input)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $author = null;
        $comment = null;

        if(!empty($input['author']) && !empty($input['comment'])){
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            throw new Exception ('Les données du formulaire sont invalides');
        }

        $success = $commentRepository->createComment($post, $author, $comment);
        if(!$success){
            throw new Exception ('Impossible d\'ajouter le commentaire.');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
