<?php $title = ' admin | Modifier chapitre'; ?>

<h1>Modifier chapitre</h1>


<form action="<?= PATH_PREFIX ?>/admin/configurepost?id=<?= $post['id'] ?>&token=<?= $_SESSION['token'] ?>" method="post" class="form-group">
	<label for="title">Titre du chapitre</label> : <input type="text" id="title" name="title" value="<?= $post['title']; ?>" class="form-control col-md-3" placeholder="Ex : Chapitre 1 , 2 . . ." required/><br/>
	<label>Contenu</label> :  <textarea name="content" class="tiny-area form-control col-md-12" id="content" required>
		<?= $post['post']; ?>
	</textarea><br/>
	<input type="hidden" name="author" value="Jean Forteroche">
	<input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>" />
	<button type="button submit" name="modify" class="btn btn-outline-dark">Modifier</button>
	<button type="button submit" name="delete" class="btn btn-outline-danger">Supprimer</button>
</form>

<h2>Commentaires</h2>

<?php

while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <span class="badge badge-danger">signalement <?= $comment['signal_count']; ?></span></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
    <form action="<?= PATH_PREFIX ?>/admin/modaratecomment?id=<?= $comment['id'] ?>" method="post" class="form-group">
    	<input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>" /> 
    	<button type="button submit" name="nosignal" class="btn btn-outline-dark">Enlever signalement</button>
    	<button type="button submit" name="delete" class="btn btn-outline-danger">Supprimer le commentaire</button>
    </form>
<?php
} 
if ($totalPages > 1) {
	for ($i = 1; $i <= $totalPages; $i++) { 
		if ($i == $currentPage) {
			echo $i;
		} else {
			echo "<a href='" . PATH_PREFIX . "/admin/modifier-chapitre?id=" . $post['id'] . "&page=" . $i . "'> " . $i . " </a> ";
		}
	}
}
?>