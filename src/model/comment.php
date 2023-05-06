<?php

namespace Application\Model\Comment;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Comment
{
    public string $author;
    public string $frenchCreationDate;
    public string $comment;
    public string $identifier;
    public string $postId;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments($identifier): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS
            french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );

        $statement->execute([$identifier]);

        $comments = [];
        while(($row=$statement->fetch())) {
            $comment = new Comment();
            $comment->author = $row['author'];
            $comment->french_creation_date = $row['french_creation_date'];
            $comment->comment = $row['comment'];
            $comment->identifer = $row['id'];
            
            $comments[] = $comment;
        }

        return $comments;
    }

    public function createComment(string $post, string $author, string $comment)
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function getComment(string $identifier)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT comment, post_id FROM comments WHERE id = ?'
        );
        $statement->execute([$identifier]);
       
        $row = $statement->fetch();
        $comment = new Comment();
        $comment->comment = $row['comment'];
        $comment->identifier = $identifier;
        $comment->postId = $row['post_id'];

        return $comment;
    }

    public function modifyComment(string $identifier, string $comment)
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET comment = ? WHERE id = ?'
        );
        $modifiedLine = $statement->execute(
            [$comment, $identifier]
        );

        return ($modifiedLine > 0);
    }
}