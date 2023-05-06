<?php

namespace Application\Controllers\ModifyComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;

class ModifyComment
{
    public function modifyComment(string $identifier, array $input)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();

        $comment = null;
        $postId = null;
        if(!empty($input['comment']) && !empty($input['postId'])){
            $comment = $input['comment'];
            $postId = $input['postId'];
        } else {
            throw new Exception ('Les données du formulaire sont invalides');
        }

        $success = $commentRepository->modifyComment($identifier, $comment);
        if(!$success){
            throw new Exception ('Impossible de modifier le commentaire.');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
}
