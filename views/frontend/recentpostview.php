<?php $title = 'Acceuil | Blog Jean Forteroche'; ?>

<h1>Post Recent</h1>

<?php
while ($data = $posts->fetch()){
?>
	<div class="news">
		<h2>
			<?= htmlspecialchars($data['title']); ?>
		</h2>
			    
		<p>
			<?= nl2br(htmlspecialchars($data['post'])); ?>
		</p>
		<p>
			<?= htmlspecialchars($data['author']); ?>
			<em>le <?= $data['date_creation_fr']; ?></em>
		</p>
		<p>
			<em><a href="/courPHP/blog_projet_4/commentaire?id=<?= $data['id'] ?>">Commentaires</a></em>
		</p>
	</div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
