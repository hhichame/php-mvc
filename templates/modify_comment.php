<?php $title="Le blog de l'AVBN" ?>

<?php ob_start(); ?>
<h1>Le super blog de l'AVBN !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h2>Modifier</h2>
<form action="index.php?action=modifyComment&id=<?= $comment->identifier ?>" method="post">
    <input type="hidden" id="postId" name="postId" value="<?=$comment->postId ?>" />
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= $comment->comment ?></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
