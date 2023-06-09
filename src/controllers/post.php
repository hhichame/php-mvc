<?php

// controllers/post.php

namespace Application\Controllers\Post;

require_once('src/lib/database.php');
require_once('src/model/post.php');
require_once('src/model/comment.php');

use Application\Model\Post\PostRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class Post
{
    public function execute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $post = $postRepository->getPost($identifier);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;
        $comments = $commentRepository->getComments($identifier);

        require_once('templates/post.php');
    }
}