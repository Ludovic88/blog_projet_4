<?php $title = htmlspecialchars($post['title']) . ' | Laisser votre commentaire'; ?>

<h1>Commentez le chapitre</h1>


<h2>
    <?= htmlspecialchars($post['title']); ?>
</h2>
                
<p class="chapter">
    <?= $post['post'];?>
</p>
<p>
    <?= $post['author']; ?> <em>le <?= $post['date_creation_fr']; ?></em>
</p>


<h2>Laisser un commentaire</h2>
<form action="<?= PATH_PREFIX ?>/addcomment?id=<?= $post['id'] ?>&token=<?= $_SESSION['token'] ?>" method="post" class="form-group">
    <label for="author">Pseudo</label> : <input type="text" id="author" name="author" class="form-control col-md-3" placeholder="Ex : Jean" required/><br/>
    <label for="comment">Message</label> :  <textarea name="comment" id="comment" class="form-control col-md-6" rows="3" placeholder="Votre commentaire . . ." required></textarea><br/>
    <button type="button submit" class="btn btn-outline-dark">Envoyer</button>
</form>

<h2>Commentaires</h2>

<?php

while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <a href="<?= PATH_PREFIX ?>/signalcomment?id=<?= $comment['id'] ?>" class="badge badge-pill badge-danger">signaler</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
<?php
} // Fin de la boucle des commentaires
?>
