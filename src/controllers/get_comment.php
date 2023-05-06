<?php

namespace Application\Controllers\GetComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Model\Comment\CommentRepository;
use Application\Lib\Database\DatabaseConnection;

class GetComment
{
    public function getComment($identifier)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $comment = $commentRepository->getComment($identifier);

        require_once('templates/modify_comment.php');
    }
}
