<?php
// index.php

require_once('src/controllers/add_comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/modify_comment.php');
require_once('src/controllers/get_comment.php');

use Application\Controllers\Post\Post;
use Application\Controllers\HomePage\HomePage;
use Application\Controllers\AddComment\AddComment;
use Application\Controllers\ModifyComment\ModifyComment;
use Application\Controllers\GetComment\GetComment;

try{
    if(isset($_GET['action']) && $_GET['action'] !== ''){
        if($_GET['action'] === 'post'){
            if(isset($_GET['id']) && $_GET['id'] > 0){
                $identifier = $_GET['id'];
                
                $postController = new Post();

                $postController->execute($identifier);
            } else {
                throw new Exception('aucun identifiant pour de billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if(isset($_GET['id']) && $_GET['id'] > 0){
                $identifier = $_GET['id'];

                $addComment = new AddComment();

                $addComment->addComment($identifier, $_POST);
            } else {
                throw new Exception ('aucun identifiant pour le billet envoyé');
            }
        } elseif ($_GET['action'] === 'getComment') {
            if(isset($_GET['id']) && $_GET['id'] > 0){
                $identifier = $_GET['id'];

                $getComment = new GetComment();

                $getComment->getComment($identifier);
            } else {
                throw new Exception ('aucun identifiant pour le commentaire envoyé');
            }
        } elseif ($_GET['action'] === 'modifyComment') {
            if(isset($_GET['id']) && $_GET['id'] > 0){
                
                $identifier = $_GET['id'];

                $modifyComment = new ModifyComment();

                $modifyComment->modifyComment($identifier, $_POST);
                
            } else {
                throw new Exception ('aucun identifiant pour le commentaire envoyé');
            }
               
        } else {
            throw new Exception ('404 - la page que vous recherchez n\'existe pas.');
        }
    } else {
        $homepage = new HomePage();

        $homepage->homepage();
    }
} catch (Exception $e){
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}