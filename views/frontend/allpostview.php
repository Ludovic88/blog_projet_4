<?php $title = 'Livre complet | Blog Jean Forteroche'; ?>

<h1>Livre complet</h1>

<?php
while ($data = $posts->fetch()){
?>
	<div class="news">
		<h2>
			<a href="<?= PATH_PREFIX ?>/post?id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
		</h2>
			    
		<p class="chapter">
			<?= $data['post']; ?>
		</p>
		<p>
			<?= htmlspecialchars($data['author']); ?>
			<em>le <?= $data['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/post?id=<?= $data['id'] ?>">Commentaires</a></em>
		</p>
	</div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
