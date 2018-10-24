<?php $title = 'Modifier chapitre | Blog Jean Forteroche'; ?>

<h1>Livre complet</h1>

<?php
while ($data = $posts->fetch()){
?>
	<div>
		<h2>
			<a href="<?= PATH_PREFIX ?>/admin/modifier-chapitre?id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']); ?></a>
		</h2>
			    
		<p class="chapter">
			<?= $data['post']; ?>
		</p>
		<p>
			<?= htmlspecialchars($data['author']); ?>
			<em>le <?= $data['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="<?= PATH_PREFIX ?>/admin/modifier-chapitre?id=<?= $data['id'] ?>">Modifier / suprimer chapitre | moderer commentaire</a></em>
		</p>
	</div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>