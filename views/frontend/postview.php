<!-- =====  FRONTEND // PAGE QUI AFFICHE UN POST ET SES COMMENTAIRE(S)  =====  -->


<!-- ===  TITRE ENTETE  === -->
<?php $title = htmlspecialchars($post['title']) . ' | Laisser votre commentaire'; ?>



<!-- ===  PARTIE POST  === -->
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



<!-- ===  PARTIE COMMENTAIRE / PAGINATION 5 COMMENTAIRES  === -->
<h2>Laisser un commentaire</h2>
<form action="<?= PATH_PREFIX ?>/addcomment?id=<?= $post['id'] ?>" method="post" class="form-group">
    <label for="author">Pseudo</label> : <input type="text" id="author" name="author" class="form-control col-md-3" placeholder="Ex : Jean" required/><br/>
    <label for="comment">Message</label> :  <textarea name="comment" id="comment" class="form-control col-md-6" rows="3" placeholder="Votre commentaire . . ." required></textarea><br/>
    <?php \blogApp\core\Csrf::generateInput(); ?>
    <button type="button submit" class="btn btn-outline-dark">Envoyer</button>
</form>

<h2>Commentaires</h2>

<?php
foreach ($comments as $comment):
?>
    <p><strong><?= htmlspecialchars($comment['author']); ?></strong> <em>le <?= $comment['date_commentaire_fr']; ?></em> <a href="<?= PATH_PREFIX ?>/signalcomment?id=<?= $comment['id'] ?>" class="badge badge-pill badge-danger">signaler</a></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>
<?php
endforeach;
// ===> PAGINATION
if ($totalPages > 1){
	for ($i = 1; $i <= $totalPages; $i++) { 
		if ($i == $currentPage) {
			echo $i;
		} else {
			echo "<a href='" . PATH_PREFIX . "/post?id=" . $post['id'] . "&page=" . $i . "'> " . $i . " </a> ";
		}
	}
}
?>