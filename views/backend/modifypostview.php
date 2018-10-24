<?php $title = ' admin | Modifier chapitre'; ?>

<h1>Modifier chapitre</h1>


<form action="<?= PATH_PREFIX ?>/admin/updatepost?id=<?= $post['id'] ?>&token=<?= $_SESSION['token'] ?>" method="post" class="form-group">
	<label for="title">Titre du chapitre</label> : <input type="text" id="title" name="title" value="<?= $post['title']; ?>" class="form-control col-md-3" placeholder="Ex : Chapitre 1 , 2 . . ." required/><br/>
	<label>Contenu</label> :  <textarea name="content" class="tiny-area form-control col-md-12" id="content" required>
		<?= $post['post']; ?>
	</textarea><br/>
	<input type="hidden" name="author" value="Jean Forteroche">
	<button type="button submit" name="save" class="btn btn-outline-dark">Modifier</button>
</form>
<form action="<?= PATH_PREFIX ?>/admin/deletepost?id=<?= $post['id'] ?>&token=<?= $_SESSION['token'] ?>" method="post" class="form-group">
	<button type="button submit" class="btn btn-outline-danger">Supprimer</button>
</form>

<h2>Commentaires</h2>

<?php

while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <span class="badge badge-danger">signalement <?= $comment['signal_count']; ?></span></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
    <p><a href="<?= PATH_PREFIX ?>/admin/deletecomment?id=<?= $comment['id'] ?>&token=<?= $_SESSION['token'] ?>" style="color: red;">Supprimer le commentaire</a></p>
<?php
} 
?>